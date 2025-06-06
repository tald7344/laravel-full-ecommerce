<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class VisitCountDaily extends Model
{
  public $table = 'visit_count_daily';
  protected $fillable = [
    'model',
    'score',
    'date',
    'client_ip'
  ];

}
