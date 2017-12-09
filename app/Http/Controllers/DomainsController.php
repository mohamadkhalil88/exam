<?php

namespace App\Http\Controllers;

use App\Domain;
use App\Page;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DomainsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if (Auth::check())
        {
            $domains = Domain::all();
            return view("domains.index", ["domains" => $domains]);
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
        return view("domains.create" , ["domain" => $old]);
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
            //check if domain exist
            $domainCheck = Domain::where("domain_name",$request->input("domain_name"));
            if(!$domainCheck) {
                $domain = Domain::create([
                    "domain_name" => $request->input("domain_name"),
                    "domain_link" => $request->input("domain_link"),
                    "domain_lang" => $request->input("domain_lang"),
                    "domain_location" => $request->input("domain_location")
                ]);

                if ($domain) {
                    return redirect()->route("domains.index")
                        ->with("success", "Domain created successfully");
                }
            }
            return redirect()->back()->withInput()->with("errors","Domain already exist");
        }

        return back()->withInput()->with("errors","Error creating new domain");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Domain  $domain
     * @return \Illuminate\Http\Response
     */
    public function show(Domain $domain)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Domain  $domain
     * @return \Illuminate\Http\Response
     */
    public function edit(Domain $domain)
    {
        //
        $domain = Domain::find($domain->id);
        return view("domains.edit",["domain"=>$domain]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Domain  $domain
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Domain $domain)
    {
        //
        //
        $domainUpdate = Domain::where("id",$domain->id)->update([
            "domain_name"=>$request->input("domain_name"),
            "domain_link"=>$request->input("domain_link"),
            "domain_lang"=>$request->input("domain_lang"),
            "domain_location"=>$request->input("domain_location")
        ]);

        if($domainUpdate)
        {
            return redirect()->route("domains.index")
                ->with('success','domain updated successfully');
        }
        //redirect
        return back()->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Domain  $domain
     * @return \Illuminate\Http\Response
     */
    public function destroy(Domain $domain,$domain_id = null)
    {
        //
        $finddomain = Domain::find($domain_id);
        if($finddomain) {
            $findPages = Page::where("domain_id", $finddomain->id)->get();
            foreach($findPages as $findPage)
            {
                Post::where("page_id", $findPage->id)->delete();
                $findPage->delete();
            }
            //Page::where("domain_id", $finddomain->id)->delete();
            if ($finddomain->delete())
                return ' { result : 1 } ';
            else
                return ' { result : -1 } ';
        }
    }
}
