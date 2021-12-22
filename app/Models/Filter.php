<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Filter extends Model
{
    use HasFactory;
    protected $fillable = [
        'filter_type_id',
        'predicate_id',
        'segment_id',
        'parent_id',
        'tag_key',
        'value'
    ];

    public function predicate(){
        return $this->belongsTo(Predicate::class);
    }

    public function filterType(){
        return $this->belongsTo(FilterType::class);
    }

}
