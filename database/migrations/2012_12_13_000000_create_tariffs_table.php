<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTariffsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tariffs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedInteger('price');
            $table->unsignedInteger('max_apps');
            $table->unsignedInteger('max_templates');
            $table->unsignedInteger('max_segments');
            $table->unsignedInteger('max_pushes');
            $table->unsignedInteger('max_push_users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tariffs');
    }
}
