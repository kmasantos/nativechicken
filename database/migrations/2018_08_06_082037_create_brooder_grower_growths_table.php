<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBrooderGrowerGrowthsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brooder_grower_growths', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('broodergrower_id');
            $table->integer('collection_day');
            $table->date('date_collected');
            $table->integer('male_quantity')->nullable();
            $table->double('male_weight')->nullable();
            $table->integer('female_quantity')->nullable();
            $table->double('female_weight')->nullable();
            $table->integer('total_quantity');
            $table->double('total_weight');
        });

        Schema::table('brooder_grower_growths', function($table) {
            $table->foreign('broodergrower_id')->references('id')->on('brooder_growers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('brooder_grower_growths');
    }
}
