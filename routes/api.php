<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//POST REQUESTS
//pen, generation, line, family
Route::post('addGeneration', "GenerationTableController@addGeneration");
Route::post('addLine', "LineTableController@addLine");
Route::post('addFamily', "FamilyTableController@addFamily");
Route::post('addPen', "PenTableController@addPen");	
//brooders
Route::post('addBrooderFamily', "BrooderTableController@addBrooderFamily");
Route::post('addBrooderInventory', "BrooderInventoryTableController@addBrooderInventory");
Route::post('addBrooderFeeding', "BrooderFeedingTableController@addBrooderFeeding");
Route::post('addBrooderGrowth', "BrooderGrowthTableController@addBrooderGrowth");
//replacement
Route::post('addReplacementFamily', "ReplacementTableController@addReplacementFamily");
Route::post('addReplacementInventory', "ReplacementInventoryTableController@addReplacementInventory");
Route::post('addReplacementFeeding', "ReplacementFeedingTableController@addReplacementFeeding");
Route::post('addReplacementGrowth', "ReplacementGrowthTableController@addReplacementGrowth");
//breeders
Route::post('addBreederFamily', "BreederTableController@addBreederFamily");
Route::post('addBreederInventory', "BreederInventoryTableController@addBreederInventory");
Route::post('addBreederFeeding', "BreederFeedingTableController@addBreederFeeding");
Route::post('addEggProduction', "EggProductionTableController@addEggProduction");
Route::post('addHatcheryRecords', "HatcheryRecordsTableController@addHatcheryRecords");
Route::post('addEggQuality', "EggQualityTableController@addEggQuality");


//pheno morphos
Route::post('addPhenoMorphos', "PhenoMorphosTableController@addPhenoMorphos");
Route::post('addPhenoMorphoValues', "PhenoMorphoValuesTableController@addPhenoMorphoValues");
//mortality and sales
Route::post('addMortalityAndSales', "MortalityAndSalesTableController@addMortalityAndSales");


//GET REQUESTS
//farm and users
Route::get('getFarmID/{email}', "UserTableController@getFarmID" );
Route::get('getTimeStamp/{farm_id}', "FarmTableController@getTimeStamp" );
Route::get('getFarmInfo/{farm_id}', "FarmTableController@getFarmInfo");
Route::get('getFarmBatchingWeek/{farm_id}', "FarmTableController@getFarmBatchingWeek" );
//pen, generation, line, family
Route::get('getPen/{farm_id}', "PenTableController@getPen" );
Route::get('getGeneration/{farm_id}', "GenerationTableController@getGeneration" );
Route::get('getLine/{generation}', "LineTableController@getLine" );
Route::get('getFamilyForDisplay/{farm_id}', "FamilyTableController@getFamilyForDisplay" );
Route::get('getFamily', "FamilyTableController@getFamily" );
//brooders
Route::get('getBrooder',"BrooderTableController@getBrooder");
Route::get('getBrooderInventory/', "BrooderInventoryTableController@getBrooderInventory" );
Route::get('getBrooderFeeding/', "BrooderFeedingTableController@getBrooderFeeding" );
Route::get('getBrooderGrowth/', "BrooderGrowthTableController@getBrooderGrowth" );
//replacements
Route::get('getReplacement',"ReplacementTableController@getReplacement");
Route::get('getReplacementInventory/', "ReplacementInventoryTableController@getReplacementInventory" );
Route::get('getReplacementFeeding/', "ReplacementFeedingTableController@getReplacementFeeding" );
Route::get('getReplacementGrowth/', "ReplacementGrowthTableController@getReplacementGrowth" );
//breeders
Route::get('getBreeder',"BreederTableController@getBreeder");
Route::get('getBreederInventory/', "BreederInventoryTableController@getBreederInventory" );
Route::get('getBreederFeeding/', "BreederFeedingTableController@getBreederFeeding" );
Route::get('getEggProduction/', "EggProductionTableController@getEggProduction" );
Route::get('getHatcheryRecords/', "HatcheryRecordsTableController@getHatcheryRecords" );
Route::get('getEggQuality/', "EggQualityTableController@getEggQuality" );
Route::get('getDashBreederInventory/', "BreederInventoryTableController@getDashBreederInventory" );

//pheno morphos
Route::get('getPhenoMorphos/', "PhenoMorphosTableController@getPhenoMorphos" );
Route::get('getPhenoMorphoValues/', "PhenoMorphoValuesTableController@getPhenoMorphoValues" );
//mortality and sales
Route::get('getMortalityAndSales/', "MortalityAndSalesTableController@getMortalityAndSales" );

//UPDATE REQUESTS
Route::patch('editPen', 'PenTableController@editPen');
Route::patch('editPenCount', 'PenTableController@editPenCount');
Route::patch('editFarm', 'FarmTableController@editFarm');
Route::patch('editBrooderInventoryMaleFemale', 'BrooderInventoryTableController@editBrooderInventoryMaleFemale');
Route::patch('editReplacementInventoryMaleFemale', 'ReplacementInventoryTableController@editReplacementInventoryMaleFemale');
Route::patch('editBreederInventoryMaleFemale', 'BreederInventoryTableController@editBreederInventoryMaleFemale');
Route::patch('cullGeneration/{generation_id}', 'GenerationTableController@cullGeneration');
Route::patch('cullBrooderInventory', 'BrooderInventoryTableController@cullBrooderInventory');
Route::patch('cullReplacementInventory', 'ReplacementInventoryTableController@cullReplacementInventory');
Route::patch('cullBreederInventory', 'BreederInventoryTableController@cullBreederInventory');

//DELETE RECORDS

Route::patch('deleteBrooderFeedingRecord', 'BrooderFeedingTableController@deleteBrooderFeedingRecord');
Route::patch('deleteReplacementFeedingRecord', 'ReplacementFeedingTableController@deleteReplacementFeedingRecord');
Route::patch('deleteBreederFeedingRecord', 'BreederFeedingTableController@deleteBreederFeedingRecord');

Route::patch('deleteEggProduction', 'EggProductionTableController@deleteEggProduction');
Route::patch('deleteHatchery', 'HatcheryRecordsTableController@deleteHatchery');
Route::patch('deleteEggQuality', 'EggQualityTableController@deleteEggQuality');