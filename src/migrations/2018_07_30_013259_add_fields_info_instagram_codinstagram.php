<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsInfoInstagramcodinstagram extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('codinstagramconfig', function (Blueprint $table) {
            $table->string('idinstagram')->nullable($value = true)->after('code');
            $table->string('username')->nullable($value = true)->after('id');
            $table->string('profile_picture')->nullable($value = true)->after('username');
            $table->string('full_name')->nullable($value = true)->after('profile_picture');
            $table->string('bio')->nullable($value = true)->after('full_name');
            $table->string('website')->nullable($value = true)->after('bio');
            $table->boolean('is_business')->nullable($value = true)->after('website');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('codinstagramconfig', function (Blueprint $table) {
            //
        });
    }
}
