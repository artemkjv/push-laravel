<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tariff extends Model
{
    use HasFactory;
    public $timestamps = false;

    public const PAGINATE = 10;

    protected $fillable = [
        'id',
        'is_default',
        'name',
        'price',
        'max_apps',
        'max_templates',
        'max_segments',
        'max_pushes',
        'max_push_users'
    ];

}
