<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AutoPush extends Model
{
    use HasFactory;

    public const PAGINATE = 10;
    protected $fillable = [
        'id',
        'name',
        'user_id',
        'user_modified_id',
        'time_to_live',
        'interval_value',
        'interval_type',
        'status',
        'template_id'
    ];

    public function apps(){
        return $this->belongsToMany(App::class);
    }

    public function segments(){
        return $this->belongsToMany(Segment::class, 'segment_auto_push');
    }

    public function template(){
        return $this->belongsTo(Template::class);
    }

    public function sentPushes(){
        return $this->morphedByMany(SentPush::class, 'pushable', 'sent_pushes');
    }

}
