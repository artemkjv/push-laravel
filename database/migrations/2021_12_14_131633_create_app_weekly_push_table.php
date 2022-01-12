<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppWeeklyPushTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_weekly_push', function (Blueprint $table) {
            $table->unsignedBigInteger('weekly_push_id');
            $table->foreign('weekly_push_id')
                ->references('id')
                ->on('weekly_pushes')
                ->cascadeOnDelete();
            $table->unsignedBigInteger('app_id');
            $table->foreign('app_id')
                ->references('id')
                ->on('apps');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('app_weekly_push');
    }
}
