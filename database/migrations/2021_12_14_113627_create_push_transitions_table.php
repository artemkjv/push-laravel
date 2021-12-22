<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePushTransitionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('push_transitions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('push_user_id');
            $table->foreign('push_user_id')
                ->references('id')
                ->on('push_users')
                ->cascadeOnDelete();
            $table->timestamp('clicked_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('push_transitions');
    }
}
