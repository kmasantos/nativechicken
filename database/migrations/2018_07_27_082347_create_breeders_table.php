<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBreedersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('breeders', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('family_id');
            $table->unsignedInteger('female_family_id')->nullable();
            $table->date('date_added');
        });

        Schema::table('breeders', function($table) {
            $table->foreign('family_id')->references('id')->on('families');
            $table->foreign('female_family_id')->references('id')->on('families');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('breeders');
    }
}
