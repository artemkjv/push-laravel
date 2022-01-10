<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePushUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('push_users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('app_id');
            $table->foreign('app_id')
                ->references('id')
                ->on('apps')
                ->cascadeOnDelete();
            $table->unsignedBigInteger('platform_id');
            $table->foreign('platform_id')
                ->references('id')
                ->on('platforms');
            $table->enum('status', ['SUBSCRIBED', 'UNSUBSCRIBED'])
                ->default('SUBSCRIBED');
            $table->unsignedBigInteger('country_id');
            $table->foreign('country_id')
                ->references('id')
                ->on('countries');
            $table->unsignedBigInteger('language_id');
            $table->foreign('language_id')
                ->references('id')
                ->on('languages');
            $table->unsignedBigInteger('timezone_id');
            $table->foreign('timezone_id')
                ->references('id')
                ->on('timezones');
            $table->string('registration_id')
                ->unique();
            $table->uuid('uuid')
                ->unique();
            $table->string('device_model')->nullable();
            $table->unsignedInteger('sessions_count');
            $table->string('app_version')->nullable();
            $table->json('tags')->nullable();
            $table->unsignedBigInteger('time_in_app');
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
        Schema::dropIfExists('push_users');
    }
}
