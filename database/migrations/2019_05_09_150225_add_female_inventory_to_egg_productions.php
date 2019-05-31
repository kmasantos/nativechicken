<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFemaleInventoryToEggProductions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('egg_productions', function (Blueprint $table) {
            $table->integer('female_inventory')->unsigned()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('egg_productions', function (Blueprint $table) {
            $table->dropColumn('female_inventory');
        });
    }
}
