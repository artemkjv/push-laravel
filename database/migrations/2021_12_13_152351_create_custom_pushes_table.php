<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomPushesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('custom_pushes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->json('title');
            $table->json('body');
            $table->string('image')->nullable();
            $table->string('icon')->nullable();
            $table->string('open_url')->nullable();
            $table->string('sound')->nullable();
            $table->integer('time_to_live')->nullable();
            $table->timestamp('time_to_send');
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
            $table->enum('status', ['ACTIVE', 'PAUSE'])
                ->default('ACTIVE');
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
        Schema::dropIfExists('custom_pushes');
    }
}
