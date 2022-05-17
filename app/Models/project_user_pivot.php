<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class project_user_pivot extends Model
{

    protected $fillable = [
        'project_id',
        'user_id',
        'role'
    ];
    use HasFactory;
}
