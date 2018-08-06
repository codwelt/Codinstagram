<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldTokenInstagramcodinstagram extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('codinstagramconfig', function (Blueprint $table) {
            $table->string('code')->nullable($value = true)->after('ScopeId');
            $table->string('token')->nullable($value = true)->after('ScopeId');
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
