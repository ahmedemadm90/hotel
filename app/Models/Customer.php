<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $fillable = ['nid','name','email','country','gallery'];
    protected $casts = [
        'gallery'=>'array',
    ];
}
