<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $fillable = [
        'states_name_ar',
        'states_name_en',
        'country_id',
        'city_id'
    ];

    public function country_id()
    {
        return $this->hasOne('App\Model\Country', 'id', 'country_id');
    }

    public function city_id()
    {
        return $this->hasOne('App\Model\City', 'id', 'city_id');
    }
}
