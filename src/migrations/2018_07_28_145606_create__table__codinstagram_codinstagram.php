<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCodinstagramCodinstagram extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('codinstagramconfig', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ClientID')->nullable($value = true);
            $table->string('ClientSecret')->nullable($value = true);
            $table->string('RedirectUrl')->nullable($value = true);
            $table->integer('ScopeId')->nullable($value = true);
            $table->softDeletes();
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
        Schema::dropIfExists('codinstagramconfig');
    }
}
