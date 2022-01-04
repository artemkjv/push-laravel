<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PushTransition extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'push_user_id',
        'clicked_at'
    ];

}
