<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAutoPushAppTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auto_push_app', function (Blueprint $table) {
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
        Schema::dropIfExists('auto_pushes_apps');
    }
}
