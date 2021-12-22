<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHandleWeeklyPushesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('handle_weekly_pushes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('timezone_id');
            $table->foreign('timezone_id')
                ->references('id')
                ->on('timezones')
                ->cascadeOnDelete();
            $table->unsignedBigInteger('weekly_push_id');
            $table->foreign('weekly_push_id')
                ->references('id')
                ->on('weekly_pushes');
            $table->timestamp('time_to_send');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('handle_weekly_pushes');
    }
}
