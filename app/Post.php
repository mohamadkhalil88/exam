<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    protected $fillable = [
        "post_title",
        "post_image",
        "post_body",
        "page_id"
    ];

    public function page() {
        return $this->belongsTo('App\Page');
    }
}
