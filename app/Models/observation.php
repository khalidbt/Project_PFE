<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class observation extends Model
{
    protected $fillable = [
        'projectId',
        'meetingId',
        'localisation',
        'description',
        'created',
        'limite',
        'lever',
        'lot',
        'status',

    ];

    use HasFactory;
}
