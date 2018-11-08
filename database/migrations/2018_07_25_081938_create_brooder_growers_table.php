<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBrooderGrowersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brooder_growers', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('family_id');
            $table->date('date_added');
            $table->softDeletes();
        });

        Schema::table('brooder_growers', function($table) {
            $table->foreign('family_id')->references('id')->on('families');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('brooder_growers');
    }
}
