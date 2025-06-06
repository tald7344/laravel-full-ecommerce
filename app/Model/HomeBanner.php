<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class HomeBanner extends Model
{
    protected $table = 'home_banners';
    protected $fillable = [
      'title_ar',
      'title_en',
      'content_ar',
      'content_en',
      'image',
    ];
}
