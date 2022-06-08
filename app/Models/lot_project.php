<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lot_project extends Model
{

    use HasFactory;

    protected $fillable = [
        'id',
        'project_id',
        'lot_id',

    ];
}
