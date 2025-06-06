<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class OtherData extends Model
{
    protected $fillable = [
        'product_id',
        'data_key_ar',
        'data_key_en',
        'data_value',
    ];
}
