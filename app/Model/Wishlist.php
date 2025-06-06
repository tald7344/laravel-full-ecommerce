<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    protected $table = 'wishlist';
    protected $fillable = ['wishlist', 'user_id'];

    public function user() {
      return $this->belongsTo('App\Model\User');
    }
}
