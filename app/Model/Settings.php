<?php

namespace App\Model;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Settings extends Authenticatable
{
    use Notifiable;

    protected $table = 'settings';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sitename_ar',
        'sitename_en',
        'logo',
        'icon',
        'email',
        'default_lang',
        'description',
        'keywords',
        'menu_control',
        'status',
        'message_maintenance',
    ];

}
