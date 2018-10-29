<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBrooderGrowerFeedingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brooder_grower_feedings', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('broodergrower_inventory_id');
            $table->unsignedInteger('pen_id');
            $table->date('date_collected');
            $table->double('amount_offered');
            $table->double('amount_refused');
            $table->text('remarks')->nullable();
        });

        Schema::table('brooder_grower_feedings', function($table) {
            $table->foreign('broodergrower_inventory_id')->references('id')->on('brooder_grower_inventories');
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
        Schema::dropIfExists('brooder_grower_feedings');
    }
}
