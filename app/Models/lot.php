<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lot extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'project_id',
        'desc_id',
        'collaborateur_id'

    ];
}
