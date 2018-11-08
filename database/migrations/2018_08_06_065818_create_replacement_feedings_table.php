<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReplacementFeedingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('replacement_feedings', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('replacement_inventory_id');
            $table->date('date_collected');
            $table->double('amount_offered');
            $table->double('amount_refused');
            $table->text('remarks')->nullable();
        });

        Schema::table('replacement_feedings', function($table) {
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
        Schema::dropIfExists('replacement_feedings');
    }
}
