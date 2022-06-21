<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApiTokenApiPageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('api_token_api_page', function (Blueprint $table) {
            $table->unsignedBigInteger('api_token_id');
            $table->foreign('api_token_id')
                ->references('id')
                ->on('api_tokens')
                ->cascadeOnDelete();
            $table->unsignedBigInteger('api_page_id');
            $table->foreign('api_page_id')
                ->references('id')
                ->on('api_pages')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('api_token_api_page');
    }
}
