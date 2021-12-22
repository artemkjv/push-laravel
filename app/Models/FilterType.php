<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class FilterType extends Model
{
    use HasFactory;

    public function predicates(){
        return $this->belongsToMany(Predicate::class);
    }

    public function getRelatedEntities(){
        $relatedTableName = $this->table_name;
        if(is_null($relatedTableName)) return null;
        return DB::table($relatedTableName)
            ->get();
    }

}
