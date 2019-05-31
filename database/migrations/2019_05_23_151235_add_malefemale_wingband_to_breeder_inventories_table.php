<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMalefemaleWingbandToBreederInventoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('breeder_inventories', function (Blueprint $table) {
            if ((DB::connection()->getPdo()->getAttribute(PDO::ATTR_DRIVER_NAME) == 'mysql') && version_compare(DB::connection()->getPdo()->getAttribute(PDO::ATTR_SERVER_VERSION), '5.7.8', 'ge')) {
                $table->json('male_wingbands')->nullable()->after('number_male');
                $table->json('female_wingbands')->nullable()->after('number_female');
            }else{
                $table->text('male_wingbands')->nullable()->after('number_male');
                $table->text('female_wingbands')->nullable()->after('number_female');
            }
            $table->string('breeder_code')->nullable()->after('breeder_tag'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('breeder_inventories', function (Blueprint $table) {
            $table->dropColumn('male_wingbands');
            $table->dropColumn('female_wingbands');
            $table->dropColumn('breeder_code');
        });
    }
}
