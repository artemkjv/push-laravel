<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAutoPushesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auto_pushes', function (Blueprint $table) {
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
            $table->enum('status', ['ACTIVE', 'PAUSE'])
                ->default('ACTIVE');
            $table->unsignedBigInteger('template_id');
            $table->foreign('template_id')
                ->references('id')
                ->on('templates');
            $table->timestamp('time_to_send');
            $table->unsignedInteger('time_to_live')
                ->nullable();
            $table->unsignedInteger('interval_value');
            $table->enum('interval_type', ['hour', 'day', 'week']);
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
        Schema::dropIfExists('auto_pushes');
    }
}
