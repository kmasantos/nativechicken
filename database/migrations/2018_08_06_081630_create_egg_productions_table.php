<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEggProductionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('egg_productions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('breeder_inventory_id');
            $table->date('date_collected');
            $table->integer('total_eggs_intact')->default(0);
            $table->double('total_egg_weight')->default(0);
            $table->integer('total_broken')->default(0);
            $table->integer('total_rejects')->default(0);
            $table->text('remarks')->nullable();
        });

        Schema::table('egg_productions', function($table) {
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
        Schema::dropIfExists('egg_productions');
    }
}
