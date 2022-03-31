<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PushUser extends Model
{
    use HasFactory;

    public const UNSUBSCRIBED_STATUS = 'UNSUBSCRIBED';
    public const SUBSCRIBED_STATUS = 'SUBSCRIBED';

    protected $fillable = [
        'id',
        'registration_id',
        'app_id',
        'uuid',
        'platform_id',
        'country_id',
        'language_id',
        'timezone_id',
        'app_version',
        'device_model',
        'sessions_count',
        'active_at',
        'is_test'
    ];

    public const PAGINATE = 10;

    protected $casts = [
        'tags' => 'array'
    ];

    public function country(){
        return $this->belongsTo(Country::class);
    }

    public function language(){
        return $this->belongsTo(Language::class);
    }

    public function timezone(){
        return $this->belongsTo(Timezone::class);
    }

    public function platform(){
        return $this->belongsTo(Platform::class);
    }

    public function pushTransitions(){
        $this->hasMany(PushTransition::class);
    }

    public function app(){
        return $this->belongsTo(App::class);
    }

    public function segments(){
        return $this->belongsToMany(Segment::class);
    }

}
