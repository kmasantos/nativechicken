<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Route;

class CreatePensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pens', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('farm_id');
            $table->string('number');
            $table->string('type');
            $table->integer('total_capacity');
            $table->integer('current_capacity')->default(0);
            $table->boolean('is_active')->default(true);
        });

        Schema::table('pens', function($table) {
            $table->foreign('farm_id')->references('id')->on('farms');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pens');
    }
}
