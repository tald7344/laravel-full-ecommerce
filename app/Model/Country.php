<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Country extends Model
{
    use Notifiable;

    protected $table = 'countries';
    protected $fillable = [
        'countries_name_ar',
        'countries_name_en',
        'mob',
        'code',
        'currency',
        'logo'
    ];

    public function malls()
    {
        return $this->hasMany('App\Model\Mall', 'country_id', 'id');
    }
}
