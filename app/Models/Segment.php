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

    public function customPushes() {
        return $this->belongsToMany(CustomPush::class, 'segment_custom_push');
    }

    public function autoPushes() {
        return $this->belongsToMany(AutoPush::class, 'segment_auto_push');
    }

    public function weeklyPushes() {
        return $this->belongsToMany(WeeklyPush::class, 'segment_weekly_push');
    }

    public function filters(){
        return $this->hasMany(Filter::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function copy(){
        \DB::transaction(function (){
            $new = $this->replicate();
            $new->name = 'Copy ' . $this->name;
            $new->push();
            foreach ($this->filters as $filter){
                $newFilter = $filter->replicate();
                $newFilter->segment_id = $new->id;
                $newFilter->push();
            }
        });
    }

}
