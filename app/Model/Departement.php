<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Departement extends Model
{
    protected $fillable = [
        'dep_name_ar',
        'dep_name_en',
        'icon',
        'description',
        'keywords',
        'parent'
    ];

    public function parents() {
        return $this->hasOne('App\Model\Departement', 'id', 'parent');
    }

    public function sons() {
      return $this->hasMany('App\Model\Departement', 'parent', 'id');
    }

    public function products()
    {
      return $this->hasMany('App\Model\Product', 'department_id', 'id')->where('status', 'active');
    }
}
