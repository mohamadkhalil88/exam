<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
*/


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::middleware(["auth"])->group(function() {
    Route::get('/api/domains/delete/{domain_id?}', 'DomainsController@destroy');
    Route::get('/api/pages/delete/{page_id?}', 'PagesController@destroy');

    Route::resource("domains", "DomainsController");
    Route::resource("pages", "PagesController");
    Route::get('/domain/pages/{domain_id}', 'PagesController@index');
    //Route::resource("posts", "PostsController");
});
