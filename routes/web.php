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
        // General Routes
        Route::get('/',['as' => 'farm.index', 'uses' => 'FarmController@index']);
        Route::get('pens',['as' => 'farm.pens', 'uses' => 'FarmController@getPensPage']);
        Route::post('pens_add',['as' => 'farm.pens_add', 'uses' => 'FarmController@addPen']);
        Route::post('pens_search',['as' => 'farm.pens_search', 'uses' => 'FarmController@searchPen']);
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
        
        // General Axios Routes
        Route::get('fetch_generation', 'FarmController@fetchGenerations');
        Route::post('add_generation', 'FarmController@addGeneration');
        Route::get('search_generation/{search}', 'FarmController@searchGeneration');
        Route::post('add_line', 'FarmController@addLineToGeneration');
        Route::get('get_details/{generation}', 'FarmController@showGenerationDetails');
        Route::get('fetch_lines/{generation}', 'FarmController@fetchLinesInGeneration');
        Route::get('fetch_families', 'FarmController@fetchFamilies');
        Route::post('add_family', 'FarmController@addFamilyRecord');
        Route::get('search_family/{search}', 'FarmController@searchFamily');
        // Breeder Axios Routes
        Route::get('fetch_breeder_families', 'BreederController@fetchBreederFamilies');
        Route::post('add_breeder_submit', 'BreederController@addBreeder');
        Route::get('fetch_generation', 'BreederController@fetchGenerations');
        Route::get('fetch_line/{generation_id}', 'BreederController@fetchLines');
        Route::get('fetch_female/{line_number}/{male_family}', 'BreederController@fetchFemaleFamilies');
        Route::get('fetch_breeder_pens', 'BreederController@fetchBreederPens');    
        // Replacement Axios Routes

        // Axios Routes
        Route::get('generation_list', 'BreederController@getGenerationList');
        Route::get('line_list/{generation_id}', 'BreederController@getLinesList');
        Route::post('family_record_add', 'BreederController@addFamilyRecord');

        Route::get('replacement_list', 'ReplacementController@getReplacementList');
        
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