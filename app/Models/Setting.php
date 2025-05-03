<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'logo',
        'email',
        'phone',
        'address',
        'facebook_url',
        'instagram_url',
    ];
}
