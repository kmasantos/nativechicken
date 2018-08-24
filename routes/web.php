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

        Route::get('farm_settings', ['as' => 'farm.farm_settings', 'uses' => 'FarmController@getFarmSettingPage']);
        Route::put('farm_settings_edit', ['as' => 'farm.farm_settings_edit', 'uses' => 'FarmController@editFarmSetting']);
        // Breeder Routes
        Route::get('generation',['as' => 'farm.chicken.breeder.generation', 'uses' => 'BreederController@getGenerationsPage']);
        Route::post('generation_add',['as' => 'farm.chicken.breeder.generation_add', 'uses' => 'BreederController@addGeneration']);
        Route::get('family_record',['as' => 'farm.chicken.breeder.family_record', 'uses' => 'BreederController@getFamilyRecordsPage']);
        Route::get('family_record_new',['as' => 'farm.chicken.breeder.family_record_new', 'uses' => 'BreederController@getFamilyRecordsPageNew']);
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