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
