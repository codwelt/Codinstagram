<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DeleteFieldTalbeConfigcodinstagram extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('codinstagramconfig', function (Blueprint $table) {
            $table->dropColumn('tokenBasic');
            $table->dropColumn('codeBasic');
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
