<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'designation',
        'avatar',
        'website',
        'phone',
        'address',
        'bio',
    ];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }
}
