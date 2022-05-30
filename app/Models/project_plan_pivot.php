<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class project_plan_pivot extends Model
{


    protected $fillable = [
        'project_id',
        'plan_id',

    ];
    use HasFactory;
}
