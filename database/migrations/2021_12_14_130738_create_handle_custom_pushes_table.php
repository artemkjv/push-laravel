<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHandleCustomPushesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('handle_custom_pushes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('timezone_id');
            $table->foreign('timezone_id')
                ->references('id')
                ->on('timezones')
                ->cascadeOnDelete();
            $table->unsignedBigInteger('custom_push_id');
            $table->foreign('custom_push_id')
                ->references('id')
                ->on('custom_pushes');
            $table->timestamp('time_to_send');
            $table->boolean('sent');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('handle_custom_pushes');
    }
}
