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
            $table->unsignedInteger('pen_id');
            $table->string('breeder_tag');
            $table->date('batching_date')->nullable();
            $table->integer('number_male')->nullable();
            $table->integer('number_female')->nullable();
            $table->integer('total')->nullable();
            $table->date('last_update');
            $table->softDeletes();
        });

        Schema::table('breeder_inventories', function($table) {
            $table->foreign('breeder_id')->references('id')->on('breeders');
            $table->foreign('pen_id')->references('id')->on('pens');
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
