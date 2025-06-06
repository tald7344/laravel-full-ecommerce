<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    protected $fillable = [
        'link_name_ar',
        'link_name_en',
        'link_content_ar',
        'link_content_en',
        'url',
        'parent',
        'hasLink',
        'menu_id'
    ];

    public function sons()
    {
      return $this->hasMany('App\Model\Link', 'parent', 'id');
    }
}
