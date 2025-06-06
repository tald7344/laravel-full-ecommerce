<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Mall extends Model
{
    protected $fillable = [
        'malls_name_ar',
        'malls_name_en',
        'facebook',
        'twitter',
        'website',
        'contact_name',
        'mobile',
        'email',
        'address',
        'lat',
        'lag',
        'image',
        'country_id'
    ];

    public function country()
    {
        return $this->belongsTo('App\Model\Country', 'country_id', 'id');
    }

}
