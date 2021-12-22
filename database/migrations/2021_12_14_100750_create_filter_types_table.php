<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilterTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('filter_types', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('description');
            $table->string('table_name')->nullable();
            $table->string('field_name');
            $table->string('format')->nullable();
            $table->string('measurement')->nullable();
            $table->boolean('key_allowed');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('filter_types');
    }
}
