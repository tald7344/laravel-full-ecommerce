<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
      'reviewer_name', 'review_text', 'review', 'product_id', 'isApprove'
    ];
}
