<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PushUser extends Model
{
    use HasFactory;

    public const PAGINATE = 10;

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

}
