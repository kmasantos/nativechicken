<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBreederInventoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('breeder_inventories', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('breeder_id');
            $table->date('date_removed')->nullable();
            $table->integer('number_male')->nullable();
            $table->integer('number_female')->nullable();
            $table->integer('total')->nullable();
            $table->date('last_update');
        });

        Schema::table('breeder_inventories', function($table) {
            $table->foreign('breeder_id')->references('id')->on('breeders');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('breeder_inventories');
    }
}
