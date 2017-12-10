<?php

namespace App\Http\Controllers;

use DarrynTen\GoogleNaturalLanguagePhp\GoogleNaturalLanguage;



class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*
        $config = [
            'projectId' => 'my-awesome-project'  // At the very least
        ];
        $language = new GoogleNaturalLanguage($config);
        $text = 'Google Natural Language processing is awesome!';
        $language->setText($text);

        $language->getEntities();
        $language->getSyntax();
        $language->getSentiment();
        */
        return view('home');
    }

}
