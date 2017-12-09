<?php

namespace App\Http\Controllers;

use App\Domain;
use App\Page;
use App\Post;
use Cron\CronExpression;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($domain_id = null)
    {
        //
        //
        if (Auth::check())
        {
            if(is_null($domain_id))
                $pages = Page::join('domains','domains.id','=','pages.domain_id')->select('pages.*' , 'domains.domain_name')->get();
            else
                $pages = Page::where("domain_id",$domain_id)->join('domains','domains.id','=','pages.domain_id')->select('pages.*' , 'domains.domain_name')->get();
            return view("pages.index", ["pages" => $pages]);
        }
        return view("auth.login");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $old = old();
        $domains = Domain::all();
        return view("pages.create" , ["page" => $old, "domains"=>$domains]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        if(Auth::check())
        {
            $cron = CronExpression::factory($request->input("page_freq"));
            //$next_time = date("Y-m-d H:i:s",strtotime($cron->getNextRunDate()));
            $nextObj = $cron->getNextRunDate();
            $next_time = date("Y-m-d H:i:s",$nextObj->getTimestamp());
            //check if domain exist
            $page = Page::create([
                "domain_id" => $request->input("domain_id"),
                "page_link" => $request->input("page_link"),
                "page_lang" => $request->input("page_lang"),
                "page_location" => $request->input("page_location"),
                "page_location_name" => $request->input("page_location_name"),
                "page_category" => $request->input("page_category"),
                "page_area" => $request->input("page_area"),
                "page_freq" => $request->input("page_freq"),
                "page_next_time" =>$next_time,
                "page_last_time"=>date("Y-m-d H:i:s")
            ]);

            if ($page) {
                return redirect()->route("pages.index")
                    ->with("success", "Page created successfully");
            }
        }

        return back()->withInput()->with("errors","Error creating new page");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function show(Page $page)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function edit(Page $page)
    {
        //
        $page = Page::find($page->id);
        $domains = Domain::all();
        return view("pages.edit",["page"=>$page,"domains"=>$domains]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Page $page)
    {
        //
        $cron = CronExpression::factory($request->input("page_freq"));
        $nextObj = $cron->getNextRunDate();
        $next_time = date("Y-m-d H:i:s",$nextObj->getTimestamp());
        $pageUpdate = Page::where("id",$page->id)->update([
            "domain_id" => $request->input("domain_id"),
            "page_link" => $request->input("page_link"),
            "page_lang" => $request->input("page_lang"),
            "page_location" => $request->input("page_location"),
            "page_location_name" => $request->input("page_location_name"),
            "page_category" => $request->input("page_category"),
            "page_area" => $request->input("page_area"),
            "page_freq" => $request->input("page_freq"),
            "page_next_time" =>$next_time,
            "page_last_time"=>date("Y-m-d H:i:s")
        ]);

        if($pageUpdate)
        {
            return redirect()->route("pages.index")
                ->with('success','Page updated successfully');
        }
        //redirect
        return back()->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page,$page_id = null)
    {
        //
        $findPage = Page::find($page_id);
        if($findPage) {
            Post::where("page_id", $findPage->id)->delete();
            if ($findPage->delete())
                return ' { result : 1 } ';
            else
                return ' { result : -1 } ';
        }
    }

}
