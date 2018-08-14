<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBreederFeedingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('breeder_feedings', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('breeder_id');
            $table->date('date_collected');
            $table->double('amount_offered');
            $table->double('amount_refused');
            $table->text('remarks')->nullable();
        });

        Schema::table('breeder_feedings', function($table) {
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
        Schema::dropIfExists('breeder_feedings');
    }
}
