<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('templates', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->cascadeOnDelete();
            $table->unsignedBigInteger('user_modified_id')->nullable();
            $table->foreign('user_modified_id')
                ->references('id')
                ->on('users')
                ->nullOnDelete();
            $table->string('name');
            $table->string('image')->nullable();
            $table->string('icon')->nullable();
            $table->string('open_url')->nullable();
            $table->string('sound');
            $table->json('title');
            $table->json('body');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('templates');
    }
}
