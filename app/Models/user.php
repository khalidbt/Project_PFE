<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class user extends Authenticatable
{

    use HasApiTokens, HasFactory, Notifiable;


    protected $fillable = [
        'email',
        'password',
        'abr',
        'addresse',
        'phone',
        'role',
        'society',
        'preName',
        'lastName'



    ];

    protected $hidden = [
      'password',
        'remember_token'
    ];


    use HasFactory;
}
