<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
   protected $fillable = [
       'title_ar',
       'title_en',
       'photo',
       'content_ar',
       'content_en',
       'department_id',
       'manufactory_id',
       'weight_id',
       'size_id',
       'color_id',
       'currency_id',
       'trade_id',
       'price',
       'stock',
       'size',
       'price_offer',
       'weight',
       'start_at',
       'end_at',
       'start_offer_at',
       'end_offer_at',
       'other_data',
       'status',
       'is_hot',
       'reason'
   ];

   public function department()
  {
     return $this->belongsTo('App\Model\Departement', 'department_id', 'id');
  }

   public function relatedProducts()
   {
      return $this->hasMany('App\Model\RelatedProduct');
   }

   public function malls()
  {
     return $this->belongsToMany('App\Model\Mall', 'mall_products', 'product_id', 'mall_id');
  }

  public function color()
  {
    return $this->belongsTo('App\Model\Color', 'color_id', 'id');
  }

  public function country()
  {
    return $this->belongsTo('App\Model\Country', 'currency_id', 'id');
  }

  public function sizeName()
  {
    return $this->belongsTo('App\Model\Size', 'size_id', 'id')->where('is_public', 'yes');
  }

  public function trade()
  {
    return $this->belongsTo('App\Model\TradeMark', 'trade_id', 'id');
  }

  public function weightName()
  {
    return $this->belongsTo('App\Model\Weight' , 'weight_id', 'id');
  }

  public function manufactory()
  {
    return $this->belongsTo('App\Model\Manufactory' , 'manufactory_id', 'id');
  }

   public function otherData()
   {
        return $this->hasMany('App\Model\OtherData' , 'product_id', 'id');
   }

   public function reviews()
   {
     return $this->hasMany('App\Model\Review' , 'product_id', 'id')->where('reviews.isApprove', 1);
   }

  public function files()
  {
      /**
       * relation_id : from File Class (files table)
       * id : from this class Product (products table)
       */
      return $this->hasMany('App\Model\File', 'relation_id', 'id')->where('file_type', 'product');
  }
}
