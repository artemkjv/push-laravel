<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilterTypePredicateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('filter_type_predicate', function (Blueprint $table) {
            $table->unsignedBigInteger('filter_type_id');
            $table->foreign('filter_type_id')
                ->references('id')
                ->on('filter_types');
            $table->unsignedBigInteger('predicate_id');
            $table->foreign('predicate_id')
                ->references('id')
                ->on('predicates');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('filter_type_predicate');
    }
}
