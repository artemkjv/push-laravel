<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePushUserSegmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('push_user_segment', function (Blueprint $table) {
            $table->unsignedBigInteger('segment_id');
            $table->foreign('segment_id')
                ->references('id')
                ->on('segments')
                ->cascadeOnDelete();
            $table->unsignedBigInteger('push_user_id');
            $table->foreign('push_user_id')
                ->references('id')
                ->on('push_users')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('push_user_segment');
    }
}
