<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProvidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('providers', function (Blueprint $table) {
            $table->bigIncrements('providerIdx');
            $table->integer('userIdx');
            $table->foreign('userIdx')->references('userIdx')->on('users');
            $table->integer('regionIdx');
            $table->foreign('regionIdx')->references('regionIdx')->on('regions');
            $table->string('companyName');
            $table->string('companyURL');
            $table->string('companyLogo');
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
        Schema::dropIfExists('providers');
    }
}
