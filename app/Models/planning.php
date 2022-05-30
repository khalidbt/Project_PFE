<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class planning extends Model
{

    protected $fillable = [
        'startDate',
        'endDate',
        'description',
        'category',
        'concerne',
        'project_id',
        'name',

    ];
    use HasFactory;
}
