<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->middleware('guest');

Route::group(['middleware' => ['web']], function ()
{
    Auth::routes();
    Route::get('/home', 'HomeController@index')->name('home');
    // Farm Routes
    Route::group(['prefix' => 'farm'], function()
    {
        // Test Routes
        Route::get('test', ['as' => 'farm.test', 'uses' => 'FarmController@testPage']);

        /*******************
        ***LARAVEL ROUTES***
        *******************/
        // General Routes
        Route::get('/', ['as' => 'farm.index', 'uses' => 'FarmController@index']);
        Route::get('pens',['as' => 'farm.pens', 'uses' => 'FarmController@getPensPage']);
        Route::patch('set_batching', ['as' => 'farm.set_batching', 'uses' => 'FarmController@setBatching']);
        Route::get('generation_lines_page', ['as' => 'farms.generation_lines_page', 'uses' => 'FarmController@getGenerationLinesPage']);
        Route::get('family_records', ['as' => 'farm.family_records', 'uses' => 'FarmController@getFamilyRecordsPage']);
        Route::get('farm_settings', ['as' => 'farm.farm_settings', 'uses' => 'FarmController@getFarmSettingPage']);
        Route::put('farm_settings_edit', ['as' => 'farm.farm_settings_edit', 'uses' => 'FarmController@editFarmSetting']);
        Route::get('farm_records', ['as' => 'farm.farm_records', 'uses' => 'FarmController@farmRecords']);
        Route::get('generation_records', ['as' => 'farm.generation_records', 'uses' => 'FarmController@generationRecords']);
        
        // Breeder Routes
        Route::get('generation',['as' => 'farm.chicken.breeder.generation', 'uses' => 'BreederController@getGenerationsPage']);
        Route::post('generation_add',['as' => 'farm.chicken.breeder.generation_add', 'uses' => 'BreederController@addGeneration']);
        Route::post('generation_search', ['as' => 'farm.chicken.breeder.generation_search', 'uses' => 'BreederController@searchGeneration']);
        Route::post('generation_add_line', ['as' => 'farm.chicken.breeder.generation_add_line', 'uses' => 'BreederController@addLine']);

        Route::get('family_record',['as' => 'farm.chicken.breeder.family_record', 'uses' => 'BreederController@getFamilyRecordsPage']);
        Route::get('family_record_new',['as' => 'farm.chicken.breeder.family_record_new', 'uses' => 'BreederController@getFamilyRecordsPageNew']);
        Route::post('family_record_search',['as' => 'farm.chicken.breeder.family_record_search', 'uses' => 'BreederController@searchFamilyRecordsPage']);

        Route::get('add_breeder', ['as' => 'farm.chicken.breeder.add_breeder', 'uses' => 'BreederController@addBreederPage']);

        Route::get('hatchery_record', ['as' => 'farm.chicken.breeder.hatchery_record', 'uses' => 'BreederController@hatcheryRecordPage']);
        Route::get('egg_quality', ['as' => 'farm.chicken.breeder.egg_quality', 'uses' => 'BreederController@eggQualityPage']);
        Route::get('breeder_inventory', ['as' => 'farm.chicken.breeder.breeder_inventory', 'uses' => 'BreederController@breederInventoryPage']);

        // Replacement Routes
        Route::get('replacement_add',['as' => 'farm.chicken.replacemnt.replacement_add', 'uses' => 'ReplacementController@getAddReplacement']);
        Route::get('phenomorpho_record',['as' => 'farm.chicken.replacemnt.phenomorpho_record', 'uses' => 'ReplacementController@phenoMorphoPage']);
        Route::get('feeding_record',['as' => 'farm.chicken.replacemnt.feeding_record', 'uses' => 'ReplacementController@feedingRecordPage']);
        Route::get('add_pheno_morpho/{id}', ['as' => 'farm.chicken.replacement.add_pheno_morpho', 'uses' => 'ReplacementController@addPhenoMorphoPage']);

        // Brooder & Grower Routes
        Route::get('broodergrower_add', ['as' => 'farm.chicken.broodergrower.broodergrower_add', 'uses' => 'BrooderGrowerController@getAddBrooderGrower']);
        Route::get('broodergrower_feedingrecord', ['as' => 'farm.chicken.broodergrower.broodergrower_feedingrecord', 'uses' => 'BrooderGrowerController@getFeedingRecord']);
        Route::get('broodergrower_growthrecord', ['as' => 'farm.chicken.broodergrower.broodergrower_growthrecord', 'uses' => 'BrooderGrowerController@getGrowthRecord']);

        /*****************
        ***AXIOS ROUTES***
        *****************/
        // General Axios Routes
        Route::get('fetch_pens', 'FarmController@fetchPens');
        Route::post('add_pens', 'FarmController@addPen');
        Route::get('search_pens/{search_array}', 'FarmController@searchPen');
        Route::patch('edit_pen', 'FarmController@editPen');
        Route::delete('delete_pen/{pen_id}', 'FarmController@deletePen');
        Route::get('fetch_generation', 'FarmController@getGenerations');
        Route::post('add_generation', 'FarmController@addGeneration');
        Route::get('search_generation/{search}', 'FarmController@searchGeneration');
        Route::post('add_line', 'FarmController@addLineToGeneration');
        Route::get('get_details/{generation}', 'FarmController@showGenerationDetails');
        Route::get('get_generation_list', 'FarmController@fetchGenerations');
        Route::get('fetch_lines/{generation}', 'FarmController@fetchLinesInGeneration');
        Route::get('fetch_families', 'FarmController@fetchFamilies');
        Route::post('add_family', 'FarmController@addFamilyRecord');
        Route::get('search_family/{search}', 'FarmController@searchFamily');
        Route::get('get_dashboard_data', 'FarmController@getDashData');
        Route::patch('cull_generation/{generation_id}', 'FarmController@cullGeneration');
        Route::get('family_summary', 'FarmController@getGenerationSummary');
        Route::get('family_pheno_morpho_genfam/{generation_id}', 'FarmController@getPhenoMorphoFamilySummary');
        Route::get('family_feeding_summary/{generation_id}/{year}', 'FarmController@feedingRecordPerFamily');
        Route::get('family_egg_quality_summary/{generation_id}/{year}', 'FarmController@eggQualityPerFamily');
        Route::get('family_egg_production_summary/{generation_id}/{year}', 'FarmController@eggProductionPerFamily');
        Route::get('family_hatchery_record_summary/{generation_id}/{year}', 'FarmController@hatcheryRecordPerFamily');
        Route::get('family_growth_summary/{generation_id}/{year}', 'FarmController@growthRecordPerFamily');
        Route::get('family_mortality_summary/{generation_id}', 'FarmController@mortalitySalesPerFamily');
        Route::get('family_inventory_summary/{generation_id}', 'FarmController@getInventoryPerFamily');
        Route::get('generation_pheno_morpho', 'FarmController@getPhenoMorphoGeneration');
        Route::get('generation_feeding/{year}', 'FarmController@getFeedingRecordGeneration');
        Route::get('generation_growth/{year}', 'FarmController@getGrowthRecordGeneration');
        Route::get('generation_eggqual/{year}', 'FarmController@eggQualityGeneration');
        Route::get('generation_eggprod/{year}', 'FarmController@eggProductionGeneration');
        Route::get('generation_hatchery/{year}', 'FarmController@getHatcheryRecordGeneration');
        Route::get('generation_inventory', 'FarmController@getInventoryGeneration');
        Route::get('generation_mortality', 'FarmController@getMortalityGeneration');

        // Breeder Axios Routes
        Route::get('breeder_list', 'BreederController@getBreederList');
        Route::post('add_breeder', 'BreederController@addBreeder');
        Route::get('breeder_fetch_generation', 'BreederController@fetchGenerations');
        Route::get('breeder_fetch_line/{generation_id}', 'BreederController@fetchLines');
        Route::get('breeder_fetch_families/{line_id}', 'BreederController@fetchFamilies');
        Route::get('breeder_fetch_female_families/{line_number}/{male_family}', 'BreederController@fetchFemaleFamilies');
        Route::get('breeder_fetch_pens', 'BreederController@fetchBreederPens');
        Route::get('breeder_fetch_brooder_pens', 'BreederController@fetchBrooderPens');
        Route::get('breeder_fetch_inventories/{family_id}', 'BreederController@fetchReplacementInventories');
        Route::get('search_breeder/{breeder_tag}', 'BreederController@searchBreederTag');
        /**
         * *New Axios Routes for Breeders
         */
        Route::get('breeder_feeding/{breeder_id}', 'BreederController@fetchFeedingRecords');
        Route::post('breeder_feeding', 'BreederController@addFeedingRecords');
        Route::get('breeder_eggprod/{breeder_id}', 'BreederController@fetchEggProduction');
        Route::post('breeder_add_eggprod', 'BreederController@addEggProduction');
        Route::get('breeder_hatchery/{breeder_inventory}', 'BreederController@getHatcheryParameter');
        Route::post('breeder_add_hatchery', 'BreederController@addHatcheryParameter');
        Route::get('breeder_eggquality/{breeder_inventory}', 'BreederController@fetchEggQuality');
        Route::post('breeder_add_eggquality', 'BreederController@addEggQuality');
        Route::get('breeder_phenomorpho_records/{inventory_id}', 'BreederController@getPhenoMorphoRecord');
        Route::post('breeder_add_phenomorpho', 'BreederController@addPhenoMorphoRecords');
        Route::get('breeder_mortalitysale_record/{inventory_id}', 'BreederController@getMortalitySale');
        Route::post('breeder_mortality', 'BreederController@addMortality');
        Route::post('breeder_sale', 'BreederController@addSale');
        Route::post('breeder_egg_sale', 'BreederController@addEggSale');
        Route::delete('cull_breeder/{inventory_id}', 'BreederController@cullBreeder');
        Route::post('add_breeder_additional', 'BreederController@addAdditionalBreeder');
        Route::post('breeder_delete_hatcheryrecord', 'BreederController@deleteHatcheryRecord');
        Route::patch('breeder_edit_hatchery', 'BreederController@editHatcheryRecord');
        Route::delete('breeder_delete_feeding/{record_id}', 'BreederController@deleteFeedingRecord');
        Route::delete('breeder_delete_eggquality/{record_id}', 'BreederController@deleteEggQuality');
        Route::delete('breeder_delete_eggprod/{record_id}', 'BreederController@deleteEggProduction');
        Route::delete('breeder_delete_phenomorphorecords/{record}', 'BreederController@deletePhenoMorphoRecord');
        Route::get('breeder_hatchery_generation/{breeder_inventory}', 'BreederController@fetchNewGenerations');
        /**
         * *New Axios Routes for Replacement
         */
        Route::get('replacement_pens', 'ReplacementController@getReplacementPens');
        Route::get('search_replacement_pens/{search}', 'ReplacementController@searchReplacementPens');
        Route::get('replacement_fetch_generations', 'ReplacementController@fetchGenerations');
        Route::get('replacement_fetch_lines/{generation_id}', 'ReplacementController@fetchLines');
        Route::get('replacement_fetch_families/{line_id}', 'ReplacementController@fetchFamilies');
        Route::post('add_replacements', 'ReplacementController@addReplacements');
        Route::get('replacement_pen_info/{pen_id}','ReplacementController@fetchPenInfo');
        Route::post('add_replacement_phenomorpho', 'ReplacementController@addPhenoMorpho');
        Route::post('add_replacement_feeding', 'ReplacementController@addPenFeedingRecord');
        Route::get('replacement_feeding_records/{pen_id}', 'ReplacementController@fetchFeedingRecords');
        Route::get('replacement_fetch_brooderpens/{family_id}','ReplacementController@getBrooderInventories');
        Route::get('replacement_fetch_phenomorphoinventory/{pen_id}','ReplacementController@getPhenoMorphoInventory');
        Route::get('replacement_fetch_phenomorpholist/{inventory_id}','ReplacementController@getPhenoMorphoList');
        Route::get('replacement_mortalitysale_record/{inventory_id}', 'ReplacementController@getMortalitySale');
        Route::post('replacement_mortality', 'ReplacementController@addMortality');
        Route::post('replacement_sale', 'ReplacementController@addSale');
        Route::post('replacement_egg_sale', 'ReplacementController@addEggSale');
        Route::delete('cull_replacement/{inventory_id}', 'ReplacementController@cullReplacement');
        Route::get('replacement_select_feedrecords/{record}', 'ReplacementController@selectFeedingRecords');
        Route::delete('replacement_delete_feedrecords/{record}', 'ReplacementController@deleteFeedingRecord');
        Route::get('replacement_fetch_growthrecord/{pen_id}', 'ReplacementController@fetchGrowthRecord');
        Route::post('add_replacement_growth', 'ReplacementController@addGrowthRecord');
        Route::get('replacement_select_growthrecords/{record}', 'ReplacementController@selectGrowthRecords');
        Route::delete('replacement_delete_growthrecords/{record}', 'ReplacementController@deleteGrowthRecord');
        Route::delete('replacement_delete_phenomorphorecords/{record}', 'ReplacementController@deletePhenoMorphoRecord');
        /**
         * !Old Routes, delete when replaced
         */
        Route::get('broodergrower_list','BrooderGrowerController@getBrooderGrower');
        Route::get('broodergrower_fetch_pens','BrooderGrowerController@fetchPens');
        Route::get('broodergrower_feeding_records/{pen_id}', 'BrooderGrowerController@fetchFeedingRecords');
        Route::get('broodergrower_growth_records/{pen_id}', 'BrooderGrowerController@fetchGrowthRecords');
        Route::post('add_broodergrower_growth', 'BrooderGrowerController@addGrowthRecord');

        /**
         * *New Axios Routes for Brooders
         */
        Route::get('broodergrower_fetch_generation','BrooderGrowerController@fetchGenerations');
        Route::get('broodergrower_fetch_lines/{generation_id}','BrooderGrowerController@fetchLines');
        Route::get('broodergrower_fetch_families/{line_id}','BrooderGrowerController@fetchFamilies');
        Route::get('broodergrower_pens','BrooderGrowerController@getBrooderGrowerPens');
        Route::post('add_broodergrower', 'BrooderGrowerController@addBrooderGrower');
        Route::post('add_broodergrower_feeding', 'BrooderGrowerController@addFeedingRecord');
        Route::get('broodergrower_pen_info/{pen_id}','BrooderGrowerController@fetchPenInfo');
        Route::patch('update_broodergrower', 'BrooderGrowerController@updateBrooderGrower');
        Route::get('brooder_mortalitysale_record/{inventory_id}', 'BrooderGrowerController@getMortalitySale');
        Route::post('brooder_mortality', 'BrooderGrowerController@addMortality');
        Route::post('brooder_sale', 'BrooderGrowerController@addSale');
        Route::post('brooder_egg_sale', 'BrooderGrowerController@addEggSale');
        Route::delete('cull_brooder/{inventory_id}', 'BrooderGrowerController@cullBrooder');
        Route::get('brooder_select_growthrecords/{record}', 'BrooderGrowerController@selectGrowthRecords');
        Route::delete('brooder_delete_growthrecords/{record}', 'BrooderGrowerController@deleteGrowthRecord');
        Route::get('brooder_select_feedingrecords/{record}', 'BrooderGrowerController@selectFeedingRecords');
        Route::delete('brooder_delete_feedingrecords/{record}', 'BrooderGrowerController@deleteFeedingRecord');
        Route::get('search_brooder/{search}', 'BrooderGrowerController@searchBrooderPen');
    });
    // Admin Routes
    Route::group(['prefix' => 'admin'], function()
    {
        Route::get('/',['as' => 'admin.index', 'uses' => 'AdminController@index']);
        Route::get('/user_management',['as' => 'admin.user_management', 'uses' => 'AdminController@userManagementPage']);
        Route::get('/content_management',['as' => 'admin.content_management', 'uses' => 'AdminController@contentManagementPage']);
        Route::get('/farm_status',['as' => 'admin.farm_status', 'uses' => 'AdminController@farmStatusPage']);

        /**
         * * Axios Routes for Admin
         */
        Route::get('user_list', 'AdminController@getUserList');
    });
});

// Socialite Routes
Route::get('login/google', 'Auth\LoginController@redirectToProvider')->name('google_login');
Route::get('login/google/callback', 'Auth\LoginController@handleProviderCallback');
Route::get('logout', 'Auth\LoginController@logout');
