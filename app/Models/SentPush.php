<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SentPush extends Model
{
    use HasFactory;

    public const PAGINATE = 10;

    protected $casts = [
        'title' => 'array',
        'body' => 'array'
    ];

    protected $fillable = [
        'id',
        'pushable_id',
        'pushable_type',
        'sent',
        'clicked',
        'user_id',
        'title',
        'body',
        'image',
        'icon',
        'open_url',
        'deeplink',
        'sound'
    ];

}
