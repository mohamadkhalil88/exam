<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Page;
use App\Post;
use Cron\CronExpression;
use App\MyClasses\Scrap;
//use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;


class GetNextPages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pages:next';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get the next pages.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //Regexp to collect the tag <a>
        $regexp = "<a\s[^>]*href=(\"??)([^\" >]*?)\\1[^>]*>(.*)<\/a>";
        $now = date("Y-m-d H:i:s");

        $nextPages = Page::where("page_next_time","<=",$now)->get();
        foreach ($nextPages as $nextPage)
        {
            //
            $url = $nextPage->page_link;
            $area = $nextPage->page_area;
            $matches = array();

            $dom  = new \DOMDocument();
            libxml_use_internal_errors(true);
            $html = file_get_contents($url);
            $dom->loadHTML($html);
            $xpath = new \DOMXPath($dom);
            $selector = $this->getSelectorByString($area);
            $div = $xpath->query('//*[@'.$selector.']');
            $div = $div->item(0);

            $input = $dom->saveXML($div);
            if(preg_match_all("/$regexp/siU", $input, $matches, PREG_SET_ORDER)) {
                foreach($matches as $match) {
                    //The URL find inside container inside Page
                    $read_url = $match[2];
                    $obj = new Scrap;
                    $obj::setUrl($read_url);
                    //getting the post information
                    if($obj::checkUrl()){
                        $post_title = $obj::getTitle();
                        $post_description = $obj::getMeta('description');
                        $post_image = $obj::getImg();
                        //Store them in database
                        $post = Post::create([
                            "post_title"=>$post_title,
                            "post_image"=>$post_image,
                            "post_body"=>$post_description,
                            "page_id"=>$nextPage->id
                        ]);
                        Redis::set("posts",serialize($post));
                    }else{

                    }
                }
            }

            //Update last & next visit time
            $cron = CronExpression::factory($nextPage->page_freq);
            $nextObj = $cron->getNextRunDate();
            $next_time = date("Y-m-d H:i:s",$nextObj->getTimestamp());
            $nextPage->update([
                "page_next_time"=>$next_time,
                "page_last_time"=>$now
            ]);
        }
    }

    function getSelectorByString($selector = "")
    {
        if($selector == "")
            return "";
        if($selector[0] == ".") {
            return "class=\"".ltrim($selector,".")."\"";
        }
        elseif($selector[0] == "#") {
            return "id=\"".ltrim($selector,"#")."\"";
        }
        else return "";
    }
}
