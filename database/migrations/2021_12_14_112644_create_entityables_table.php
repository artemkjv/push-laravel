<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntityablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entityables', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->cascadeOnDelete();
            $table->unsignedBigInteger('entityable_id');
            $table->string('entityable_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('entityables');
    }
}
