<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReplacementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('replacements', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('family_id');
            $table->date('batching_date')->nullable();
            $table->date('date_added');
        });

        Schema::table('replacements', function($table) {
            $table->foreign('family_id')->references('id')->on('families');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('replacements');
    }
}
