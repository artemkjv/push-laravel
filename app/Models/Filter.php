<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

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

    public function segment(){
        return $this->belongsTo(Segment::class);
    }

    public function predicate(){
        return $this->belongsTo(Predicate::class);
    }

    public function filterType(){
        return $this->belongsTo(FilterType::class);
    }

    public function children(){
        return $this->hasMany(Filter::class, 'parent_id');
    }

    public function toQuery(&$query){
        if($this->tag_key){
            return $query->{$this->predicate->value}($this->filterType->field_name,
                [$this->tag_key => $this->value]);
        }
        return $query->{$this->predicate->value}($this->filterType->field_name,
            $this->predicate->option,
            $this->filterType->format ? \DB::raw(sprintf($this->filterType->format, $this->value)) : $this->value);
    }

}
