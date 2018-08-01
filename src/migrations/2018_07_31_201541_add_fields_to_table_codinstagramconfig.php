<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToTableCodinstagramconfig extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('codinstagramconfig', function (Blueprint $table) {
            $table->string("tokenBasic")->nullable($value = true)->after("code");
            $table->string("codeBasic")->nullable($value = true)->after("tokenBasic");
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
