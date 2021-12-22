<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppPlatformTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_platform', function (Blueprint $table) {
            $table->unsignedBigInteger('app_id');
            $table->foreign('app_id')
                ->references('id')
                ->on('apps')
                ->cascadeOnDelete();
            $table->unsignedBigInteger('platform_id');
            $table->foreign('platform_id')
                ->references('id')
                ->on('platforms');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('apps_platforms');
    }
}
