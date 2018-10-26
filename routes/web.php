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

        Route::get('generation_lines_page', ['as' => 'farms.generation_lines_page', 'uses' => 'FarmController@getGenerationLinesPage']);

        Route::get('family_records', ['as' => 'farm.family_records', 'uses' => 'FarmController@getFamilyRecordsPage']);

        Route::get('farm_settings', ['as' => 'farm.farm_settings', 'uses' => 'FarmController@getFarmSettingPage']);
        Route::put('farm_settings_edit', ['as' => 'farm.farm_settings_edit', 'uses' => 'FarmController@editFarmSetting']);
        // Breeder Routes
        Route::get('generation',['as' => 'farm.chicken.breeder.generation', 'uses' => 'BreederController@getGenerationsPage']);
        Route::post('generation_add',['as' => 'farm.chicken.breeder.generation_add', 'uses' => 'BreederController@addGeneration']);
        Route::post('generation_search', ['as' => 'farm.chicken.breeder.generation_search', 'uses' => 'BreederController@searchGeneration']);
        Route::post('generation_add_line', ['as' => 'farm.chicken.breeder.generation_add_line', 'uses' => 'BreederController@addLine']);

        Route::get('family_record',['as' => 'farm.chicken.breeder.family_record', 'uses' => 'BreederController@getFamilyRecordsPage']);
        Route::get('family_record_new',['as' => 'farm.chicken.breeder.family_record_new', 'uses' => 'BreederController@getFamilyRecordsPageNew']);
        Route::post('family_record_search',['as' => 'farm.chicken.breeder.family_record_search', 'uses' => 'BreederController@searchFamilyRecordsPage']);

        Route::get('add_breeder', ['as' => 'farm.chicken.breeder.add_breeder', 'uses' => 'BreederController@addBreederPage']);

        Route::get('daily_record', ['as' => 'farm.chicken.breeder.daily_record', 'uses' => 'BreederController@dailyRecordPage']);
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

        // Breeder Axios Routes
        Route::get('breeder_list', 'BreederController@getBreederList');
        Route::post('add_breeder', 'BreederController@addBreeder');
        Route::get('breeder_fetch_generation', 'BreederController@fetchGenerations');
        Route::get('breeder_fetch_line/{generation_id}', 'BreederController@fetchLines');
        Route::get('breeder_fetch_families/{line_id}', 'BreederController@fetchFamilies');
        Route::get('breeder_fetch_female_families/{line_number}/{male_family}', 'BreederController@fetchFemaleFamilies');
        Route::get('breeder_fetch_pens', 'BreederController@fetchBreederPens');

        /**
         * *New Axios Routes for Breeders
         */
        Route::get('breeder_feeding/{breeder_id}', 'BreederController@fetchFeedingRecords');
        Route::post('add_feeding', 'BreederController@addFeedingRecords');
        Route::get('egg_prod/{breeder_id}', 'BreederController@fetchEggProduction');
        Route::post('add_egg_prod', 'BreederController@addEggProduction');
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
        Route::get('replacement_pheno_morpho/{replacement_id}', 'ReplacementController@phenoMorphoPage');
        Route::post('add_phenomorpho', 'ReplacementController@addPhenoMorpho');
        Route::post('add_penfeeding', 'ReplacementController@addPenFeedingRecord');

        /**
         * !Old Routes, delete when replaced
         */
        Route::get('broodergrower_list','BrooderGrowerController@getBrooderGrower');

        Route::get('broodergrower_fetch_pens','BrooderGrowerController@fetchPens');

        Route::get('broodergrower_feeding_records/{broodergrower_id}', 'BrooderGrowerController@fetchFeedingRecords');

        Route::get('broodergrower_growth_records/{broodergrower_id}', 'BrooderGrowerController@fetchGrowthRecords');
        Route::post('add_broodergrower_growth', 'BrooderGrowerController@addGrowthRecord');

        /**
         * *New Axios Routes for Brooders and Growers
         */
        Route::get('broodergrower_fetch_generation','BrooderGrowerController@fetchGenerations');
        Route::get('broodergrower_fetch_lines/{generation_id}','BrooderGrowerController@fetchLines');
        Route::get('broodergrower_fetch_families/{line_id}','BrooderGrowerController@fetchFamilies');
        Route::get('broodergrower_pens','BrooderGrowerController@getBrooderGrowerPens');
        Route::post('add_broodergrower', 'BrooderGrowerController@addBrooderGrower');
        Route::post('add_broodergrower_feeding', 'BrooderGrowerController@addFeedingRecord');
        Route::get('broodergrower_pen_info/{pen_id}','BrooderGrowerController@fetchPenInfo');
        Route::patch('update_broodergrower', 'BrooderGrowerController@updateBrooderGrower');

    });
    // Admin Routes
    Route::group(['prefix' => 'admin'], function()
    {
        Route::get('/',['as' => 'admin.index', 'uses' => 'AdminController@index']);
    });
});

// Socialite Routes
Route::get('login/google', 'Auth\LoginController@redirectToProvider')->name('google_login');
Route::get('login/google/callback', 'Auth\LoginController@handleProviderCallback');
Route::get('logout', 'Auth\LoginController@logout');
