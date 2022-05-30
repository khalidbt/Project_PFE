<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class zone extends Model
{


    protected $fillable = [
        'projectId',
        'zoneName',
        'addresse',
        'description',

    ];
    use HasFactory;
}
