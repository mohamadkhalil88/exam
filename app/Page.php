<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    //
    protected $fillable = [
        "page_link",
        "page_lang",
        "page_location",
        "page_location_name",
        "page_category",
        "page_area",
        "page_freq",
        "page_next_time",
        "page_last_time",
        "domain_id"
    ];

    public function domain() {
        return $this->belongsTo('App\Domain');
    }

    public function posts() {
        return $this->hasMany('App\Post');
    }
}
