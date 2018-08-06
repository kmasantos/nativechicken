<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBrooderGrowerInventoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brooder_grower_inventories', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('broodergrower_id');
            $table->integer('number_male')->nullable();
            $table->integer('number_female')->nullable();
            $table->integer('total')->default(0);
            $table->string('activity')->nullable();
            $table->unsignedInteger('pen_id')->nullable();
            $table->date('date');
            
        });

        Schema::table('brooder_grower_inventories', function($table) {
            $table->foreign('broodergrower_id')->references('id')->on('brooder_growers');
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
        Schema::dropIfExists('brooder_grower_inventories');
    }
}
