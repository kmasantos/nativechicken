<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMortalitySalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mortality_sales', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date')->nullable();
            $table->unsignedInteger('breeder_inventory_id')->nullable();
            $table->unsignedInteger('replacement_inventory_id')->nullable();
            $table->unsignedInteger('brooder_inventory_id')->nullable();
            $table->enum('type', ['breeder', 'replacement', 'brooder', 'egg']);
            $table->enum('category', ['sold', 'died', 'culled']);
            $table->double('price')->nullable();
            $table->unsignedInteger('male')->nullable();
            $table->unsignedInteger('female')->nullable();
            $table->unsignedInteger('total')->nullable();
            $table->string('reason')->nullable();
            $table->string('remarks')->nullable();
        });
        Schema::table('mortality_sales', function($table) {
            $table->foreign('breeder_inventory_id')->references('id')->on('breeder_inventories');
            $table->foreign('replacement_inventory_id')->references('id')->on('replacement_inventories');
            $table->foreign('brooder_inventory_id')->references('id')->on('brooder_grower_inventories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mortality_sales');
    }
}
