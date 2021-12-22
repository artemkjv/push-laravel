<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomPushAppTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('custom_pushes_apps', function (Blueprint $table) {
            $table->unsignedBigInteger('custom_push_id');
            $table->foreign('custom_push_id')
                ->references('id')
                ->on('custom_pushes')
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
        Schema::dropIfExists('custom_pushes_apps');
    }
}
