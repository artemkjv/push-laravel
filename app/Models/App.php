<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class App extends Model
{
    use HasFactory;

    public const PAGINATE = 10;

    protected $fillable = [
        'user_id',
        'user_modified_id',
        'title',
        'server_key',
        'sender_id',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function pushUsers(){
        return $this->hasMany(PushUser::class);
    }

    public function platforms(){
        return $this->belongsToMany(Platform::class);
    }

}
