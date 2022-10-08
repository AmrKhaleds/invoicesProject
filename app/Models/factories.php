<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class factories extends Model
{
    use HasFactory;

    protected $fillable = [
        'factory_name',
        'description',
        'created_by'
    ];
}
