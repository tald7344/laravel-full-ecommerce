<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menu';
    protected $fillable = [
        'name_ar',
        'name_en',
        'parent'
    ];

    public function links()
    {
      return $this->hasMany('App\Model\Link', 'menu_id', 'id')->where('parent', 0);
    }
}
