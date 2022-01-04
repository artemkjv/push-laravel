<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSentPushesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sent_pushes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pushable_id');
            $table->string('pushable_type');
            $table->unsignedBigInteger('sent');
            $table->unsignedInteger('clicked');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->cascadeOnDelete();
            $table->json('title');
            $table->json('body');
            $table->string('image')->nullable();
            $table->string('icon')->nullable();
            $table->string('open_url')->nullable();
            $table->string('deeplink')->nullable();
            $table->string('sound')->nullable();
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
        Schema::dropIfExists('sent_pushes');
    }
}
