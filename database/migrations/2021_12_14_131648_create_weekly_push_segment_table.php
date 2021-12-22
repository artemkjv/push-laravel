<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWeeklyPushSegmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weekly_push_segment', function (Blueprint $table) {
            $table->unsignedBigInteger('weekly_push_id');
            $table->foreign('weekly_push_id')
                ->references('id')
                ->on('weekly_pushes')
                ->cascadeOnDelete();
            $table->unsignedBigInteger('segment_id');
            $table->foreign('segment_id')
                ->references('id')
                ->on('segments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('weekly_pushes_segments');
    }
}
