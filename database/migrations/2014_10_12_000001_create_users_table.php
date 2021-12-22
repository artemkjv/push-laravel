<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->ipAddress('last_ip');
            $table->timestamp('last_login_at');
            $table->unsignedBigInteger('admin_id')
                ->nullable();
            $table->foreign('admin_id')
                ->references('id')
                ->on('users')
                ->cascadeOnDelete();
            $table->string('api_token', 80)
                ->unique()
                ->nullable()
                ->default(null);
            $table->unsignedBigInteger('tariff_id')->nullable();
            $table->foreign('tariff_id')
                ->references('id')
                ->on('tariffs');
            $table->enum('role', ['USER', 'MODERATOR', 'ADMIN', 'MANAGER']);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
