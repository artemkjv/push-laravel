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
        'icon',
        'time_to_live',
        'time_to_send',
    ];

    public function apps(){
        return $this->belongsToMany(App::class);
    }

    public function segments(){
        return $this->belongsToMany(Segment::class, 'segment_custom_push');
    }

    public function sentPushes(){
        return $this->morphedByMany(SentPush::class, 'pushable', 'sent_pushes');
    }

}
