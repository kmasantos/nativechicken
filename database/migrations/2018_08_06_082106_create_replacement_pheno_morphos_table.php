<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReplacementPhenoMorphosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('replacement_pheno_morphos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('replacement_id');
            $table->unsignedInteger('values_id');
        });

        Schema::table('replacement_pheno_morphos', function($table) {
            $table->foreign('replacement_id')->references('id')->on('replacements');
            $table->foreign('values_id')->references('id')->on('replacement_pheno_morpho_values');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('replacement_pheno_morphos');
    }
}
