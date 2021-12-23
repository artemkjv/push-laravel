<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomPush extends Model
{
    use HasFactory;

    public const PAGINATE = 10;

    protected $casts = [
        'title' => 'array',
        'body' => 'array'
    ];

}
