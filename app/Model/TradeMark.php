<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class TradeMark extends Model
{
    protected $fillable = [
        'trademarks_name_ar',
        'trademarks_name_en',
        'logo'
    ];

    public function products()
    {
      return $this->hasMany('App\Model\Product', 'trade_id', 'id');
    }

}
