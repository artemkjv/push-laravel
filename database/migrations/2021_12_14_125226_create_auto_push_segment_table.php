<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAutoPushSegmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auto_push_segment', function (Blueprint $table) {
            $table->unsignedBigInteger('auto_push_id');
            $table->foreign('auto_push_id')
                ->references('id')
                ->on('auto_pushes')
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
        Schema::dropIfExists('auto_pushes_segments');
    }
}
