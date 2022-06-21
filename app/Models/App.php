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
        'certificate',
        'private_key',
        'bundle',
        'web_certificate',
        'web_private_key',
        'web_icon',
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

    public function app(){
        return $this->belongsTo(App::class);
    }

    public function autoPushes(){
        return $this->belongsToMany(AutoPush::class);
    }

    public function customPushes(){
        return $this->belongsToMany(CustomPush::class);
    }

    public function weeklyPushes(){
        return $this->belongsToMany(WeeklyPush::class);
    }

}
