<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhenoMorphoValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pheno_morpho_values', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('gender', ['male', 'female']);
            $table->string('tag')->nullabe();
            if ((DB::connection()->getPdo()->getAttribute(PDO::ATTR_DRIVER_NAME) == 'mysql') && version_compare(DB::connection()->getPdo()->getAttribute(PDO::ATTR_SERVER_VERSION), '5.7.8', 'ge')) {
                $table->json('phenotypic');
                $table->json('morphometric');
            }else{
                $table->text('phenotypic');
                $table->text('morphometric');
            }
            $table->date('date_collected');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pheno_morpho_values');
    }
}
