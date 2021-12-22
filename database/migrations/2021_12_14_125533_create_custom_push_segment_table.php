<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomPushSegmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('custom_push_segment', function (Blueprint $table) {
            $table->unsignedBigInteger('custom_push_id');
            $table->foreign('custom_push_id')
                ->references('id')
                ->on('custom_pushes')
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
        Schema::dropIfExists('custom_pushes_segments');
    }
}
