<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class RelatedProduct extends Model
{
    protected $fillable = [ 
        'product_id', 
        'relation_product' 
    ];

    public function product() 
    {
		return $this->hasOne('App\Model\Product', 'id', 'relation_product');
	}
}
