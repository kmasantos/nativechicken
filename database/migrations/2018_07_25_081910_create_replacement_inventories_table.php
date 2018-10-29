<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReplacementInventoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('replacement_inventories', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('replacement_id');
            $table->unsignedInteger('pen_id');
            $table->date('batching_date')->nullable();
            $table->integer('number_male')->default(0);
            $table->integer('number_female')->default(0);
            $table->integer('total')->default(0);
            $table->date('last_update');
        });

        Schema::table('replacement_inventories', function($table) {
            $table->foreign('replacement_id')->references('id')->on('replacements');
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
        Schema::dropIfExists('replacement_inventories');
    }
}
