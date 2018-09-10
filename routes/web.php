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
        // General Routes
        Route::get('/',['as' => 'farm.index', 'uses' => 'FarmController@index']);
        Route::get('pens',['as' => 'farm.pens', 'uses' => 'FarmController@getPensPage']);
        Route::post('pens_add',['as' => 'farm.pens_add', 'uses' => 'FarmController@addPen']);
        Route::post('pens_search',['as' => 'farm.pens_search', 'uses' => 'FarmController@searchPen']);
        Route::get('generation_lines_page', ['as' => 'farms.generation_lines_page', 'uses' => 'FarmController@getGenerationLinesPage']);
        
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
        
        // Replacement Routes
        Route::get('replacement_add',['as' => 'farm.chicken.replacemnt.replacement_add', 'uses' => 'ReplacementController@getAddReplacement']);
        
        // General Axios Routes
        Route::get('fetch_generation', 'FarmController@fetchGenerations');
        Route::post('add_generation', 'FarmController@addGeneration');
        Route::get('search_generation/{search}', 'FarmController@searchGeneration');
        Route::post('add_line', 'FarmController@addLineToGeneration');
        // Breeder Axios Routes

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