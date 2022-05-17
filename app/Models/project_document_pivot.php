<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class project_document_pivot extends Model
{

    protected $fillable = [
        'project_id',
        'document_id'
    ];
    use HasFactory;
}
