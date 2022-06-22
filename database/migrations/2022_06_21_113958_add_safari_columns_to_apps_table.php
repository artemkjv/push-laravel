<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSafariColumnsToAppsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('apps', function (Blueprint $table) {
            $table->string('site_name')
                ->after('bundle')
                ->nullable();
            $table->string('site_url')
                ->after('bundle')
                ->nullable();
            $table->string('safari_web_id')
                ->after('bundle')
                ->nullable();
            $table->string('web_certificate')
                ->after('bundle')
                ->nullable();
            $table->string('web_private_key')
                ->after('bundle')
                ->nullable();
            $table->string('web_icon')
                ->after('bundle')
                ->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('apps', function (Blueprint $table) {
            $table->dropColumn('site_name', 'site_url', 'safari_web_id', 'web_certificate', 'web_private_key', 'web_icon');
        });
    }
}
