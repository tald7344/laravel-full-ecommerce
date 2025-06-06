<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [ 'cart' ];

    public function user()
    {
        return $this->hasOne('App\User');
    }

}
