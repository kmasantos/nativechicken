<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHatcheryRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hatchery_records', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('breeder_inventory_id');
            $table->date('date_eggs_set')->nullable();
            $table->date('batching_date')->nullable();
            $table->integer('number_eggs_set')->nullable();
            $table->integer('week_of_lay')->nullable();
            $table->integer('number_fertile')->nullable();
            $table->integer('number_hatched')->nullable();
            $table->date('date_hatched')->nullable();
        });

        Schema::table('hatchery_records', function($table) {
            $table->foreign('breeder_inventory_id')->references('id')->on('breeder_inventories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hatchery_records');
    }
}
