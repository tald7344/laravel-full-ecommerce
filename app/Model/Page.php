<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
  protected $fillable = [
    'name_en',
    'name_ar',
    'slug',
    'title_en',
    'title_ar',
    'content_ar',
    'content_en'
  ];

}
