<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class Domain extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //return parent::toArray($request);
        return [
            'domain_name' => 'aa',
            'domain_link' => 'aa',
            'domain_lang' => 'aa',
            'domain_location' => 'aa'
        ];
    }
}
