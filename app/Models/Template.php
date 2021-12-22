<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    use HasFactory;
    public const PAGINATE = 10;

    protected $fillable = [
        'id',
        'name',
        'user_id',
        'user_modified_id',
        'title',
        'body',
        'open_url',
        'deeplink',
        'image',
        'icon'
    ];

    protected $casts = [
        'title' => 'array',
        'body' => 'array'
    ];

}
