<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWeeklyPushesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weekly_pushes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
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
            $table->unsignedBigInteger('template_id');
            $table->foreign('template_id')
                ->references('id')
                ->on('templates');
            $table->set('days_to_send', [
                'monday',
                'tuesday',
                'wednesday',
                'thursday',
                'friday',
                'saturday',
                'sunday'
            ]);
            $table->time('time_to_send');
            $table->integer('time_to_live')->nullable();
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
        Schema::dropIfExists('weekly_pushes');
    }
}
