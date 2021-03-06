<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEggQualitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('egg_qualities', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('breeder_inventory_id');
            $table->date('date_collected');
            $table->integer('egg_quality_at');
            $table->double('weight')->default(0)->nullable();
            $table->string('color')->nullable();
            $table->string('shape')->nullable();
            $table->double('length')->default(0)->nullable();
            $table->double('width')->default(0)->nullable();
            $table->double('albumen_height')->default(0)->nullable();
            $table->double('albumen_weight')->default(0)->nullable();
            $table->double('yolk_weight')->default(0)->nullable();
            $table->integer('yolk_color')->nullable();
            $table->double('shell_weight')->default(0)->nullable();
            $table->double('thickness_top')->default(0)->nullable();
            $table->double('thickness_mid')->default(0)->nullable();
            $table->double('thickness_bot')->default(0)->nullable();
        });

        Schema::table('egg_qualities', function($table) {
            $table->foreign('breeder_inventory_id')->references('id')->on('breeder_inventories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('egg_qualities');
    }
}
