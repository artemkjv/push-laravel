<?php

namespace App\Models;

use App\Casts\AsSet;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeeklyPush extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'name',
        'user_id',
        'user_modified_id',
        'time_to_live',
        'time_to_send',
        'days_to_send',
        'status',
        'template_id'
    ];

    public const PAGINATE = 10;

    public $casts = [
        'days_to_send' => AsSet::class
    ];

    public function apps(){
        return $this->belongsToMany(App::class);
    }

    public function segments(){
        return $this->belongsToMany(Segment::class, 'segment_weekly_push');
    }

    public function template(){
        return $this->belongsTo(Template::class);
    }

    public function sentPushes(){
        return $this->morphedByMany(SentPush::class, 'pushable', 'sent_pushes');
    }

}
