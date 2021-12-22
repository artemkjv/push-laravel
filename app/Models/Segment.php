<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Segment extends Model
{
    use HasFactory;

    public const PAGINATE = 10;
    protected $fillable = [
        'name',
        'user_id',
        'user_modified_id',
    ];

    public function pushUsers(){
        return $this->belongsToMany(PushUser::class);
    }

    public function filters(){
        return $this->hasMany(Filter::class);
    }

}
