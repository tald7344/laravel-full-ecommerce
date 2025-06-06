<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    protected $fillable = [
        'colors_name_ar',
        'colors_name_en',
        'color'
    ];

    public function products()
    {
        return $this->hasMany('App\Model\Product', 'color_id', 'id')->where('status', 'active');
    }
}
