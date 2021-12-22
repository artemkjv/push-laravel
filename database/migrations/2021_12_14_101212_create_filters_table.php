<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFiltersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('filters', function (Blueprint $table) {
            $table->id();
            $table->string('tag_key')->nullable();
            $table->string('value');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->foreign('parent_id')
                ->references('id')
                ->on('filters')
                ->nullOnDelete();
            $table->unsignedBigInteger('segment_id');
            $table->foreign('segment_id')
                ->references('id')
                ->on('segments')
                ->cascadeOnDelete();
            $table->unsignedBigInteger('predicate_id');
            $table->foreign('predicate_id')
                ->references('id')
                ->on('predicates');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('filters');
    }
}
