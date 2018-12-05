<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReplacementGrowthsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('replacement_growths', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('replacement_inventory_id');
            $table->integer('collection_day');
            $table->date('date_collected');
            $table->integer('male_quantity')->nullable();
            $table->double('male_weight')->nullable();
            $table->integer('female_quantity')->nullable();
            $table->double('female_weight')->nullable();
            $table->integer('total_quantity');
            $table->double('total_weight');
        });

        Schema::table('replacement_growths', function($table) {
            $table->foreign('replacement_inventory_id')->references('id')->on('replacement_inventories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('replacement_growths');
    }
}
