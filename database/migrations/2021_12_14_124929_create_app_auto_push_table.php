<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppAutoPushTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_auto_push', function (Blueprint $table) {
            $table->unsignedBigInteger('auto_push_id');
            $table->foreign('auto_push_id')
                ->references('id')
                ->on('auto_pushes')
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
        Schema::dropIfExists('app_auto_push');
    }
}
