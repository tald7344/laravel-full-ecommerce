<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Manufactory extends Model
{
    protected $fillable = [
        'manufactories_name_ar',
        'manufactories_name_en',
        'facebook',
        'twitter',
        'website',
        'contact_name',
        'mobile',
        'email',
        'address',
        'lat',
        'lag',
        'icon'
    ];

}
