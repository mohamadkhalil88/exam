<?php

namespace App\MyClasses;


class Scrap{

    protected static $url = '';
    public static function setUrl($url){

        self::$url = $url;
    }

    //Check the url
    public static function checkUrl(){

        //valid url given...?
        if (filter_var(self::$url, FILTER_VALIDATE_URL) === FALSE){
            return false;
        }else{

            //cek the url status
            $array = @get_headers(self::$url);
            $status = $array[0];
            if(strpos($status,"200") or strpos($status,"301")){

                return true;
            }
            return false;
        }
    }

    //getting meta tags
    public static function getMeta($attr=null){
        if($attr){
            $meta = get_meta_tags(self::$url);
            return isset($meta[$attr]) ? $meta[$attr] : 'No meta found';
        }
        return get_meta_tags(self::$url);
    }

    private static function explodeTitle($a,$b,$c){
        $y = explode($b,$a);
        $x = explode($c,$y[1]);
        return $x[0];
    }

    //getting title
    public static function getTitle(){
        return scrap::explodeTitle(file_get_contents(self::$url),"<title>","</title>");
    }

    //get the Domain
    public static function getDomain(){
        $dmn = parse_url(self::$url);
        return $dmn['host'];
    }

    //getting images with DOMdocument
    public static function getImg(){
        $html = file_get_contents(self::$url);
        $doc = new \DOMDocument;

        @$doc->loadHTML($html);
        $tags = $doc ->getElementsByTagName('img');

        $arr = array();

        foreach ($tags as $tag) {

            $arr[] = $tag->getAttribute('src');
        }

        //return only the first image
        if(!empty($arr))
            return $arr[0];

        return "";
    }
}