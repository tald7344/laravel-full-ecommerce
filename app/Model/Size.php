<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    protected $fillable = [
        'sizes_name_ar',
        'sizes_name_en',
        'department_id',
        'is_public'
    ];

    public function department_id()
    {
        return $this->hasOne('App\Model\Departement', 'id', 'department_id');
    }
}
