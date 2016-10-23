<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $table = 'photos';

    protected $fillable = [
        'latitude',
        'longitude',
        'photo',
        'email'
    ];
}