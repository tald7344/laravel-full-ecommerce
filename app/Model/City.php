<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{    
    protected $fillable = [
        'cities_name_ar',
        'cities_name_en',
        'country_id'
    ];

	public function country_id() {
		return $this->hasOne('App\Model\Country', 'id', 'country_id');
	}
}
