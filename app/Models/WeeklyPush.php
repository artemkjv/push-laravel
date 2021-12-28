<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeeklyPush extends Model
{
    use HasFactory;

    public const PAGINATE = 10;

    public function apps(){
        return $this->belongsToMany(App::class);
    }

    public function segments(){
        return $this->belongsToMany(Segment::class, 'segment_custom_push');
    }

    public function template(){
        return $this->belongsTo(Template::class);
    }

}
