<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Domain extends Model
{
    //
    protected $fillable = [
        "domain_name",
        "domain_link",
        "domain_lang",
        "domain_location"
    ];

    public function pages() {
        return $this->hasMany('App\Page',"domain_id");
    }
}
