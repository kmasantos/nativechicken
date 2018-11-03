<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhenoMorphosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pheno_morphos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('replacement_inventory_id')->nullable();
            $table->unsignedInteger('breeder_inventory_id')->nullable();
            $table->unsignedInteger('values_id');
        });

        Schema::table('pheno_morphos', function($table) {
            $table->foreign('replacement_inventory_id')->references('id')->on('replacement_inventories');
            $table->foreign('breeder_inventory_id')->references('id')->on('breeder_inventories');
            $table->foreign('values_id')->references('id')->on('pheno_morpho_values');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pheno_morphos');
    }
}
