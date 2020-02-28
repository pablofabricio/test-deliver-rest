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
|w
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// RUNNER 
Route::get('runner', 'RunnerController@list'); 
Route::get('runner/{id}', 'RunnerController@findById');
Route::post('runner', 'RunnerController@save');
Route::put('runner/{id}' , 'RunnerController@update');
Route::delete('runner/{id}', 'RunnerController@delete');

// RACES TYPES
Route::get('race-types', 'RaceTypesController@list'); 
Route::get('race-types/{id}', 'RaceTypesController@findById');
Route::post('race-types', 'RaceTypesController@save');
Route::put('race-types/{id}' , 'RaceTypesController@update');
Route::delete('race-types/{id}', 'RaceTypesController@delete');

// AGE
Route::get('age', 'AgeController@list'); 
Route::get('age/{id}', 'AgeController@findById');
Route::post('age', 'AgeController@save');
Route::put('age/{id}' , 'AgeController@update');
Route::delete('age/{id}', 'AgeController@delete');

// RACE
Route::get('race', 'RaceController@list'); 
Route::get('race/{id}', 'RaceController@findById');
Route::post('race', 'RaceController@save');
Route::put('race/{id}' , 'RaceController@update');
Route::delete('race/{id}', 'RaceController@delete');

// RUNNER RACE
Route::get('runner-race/', 'RunnerRaceController@list'); 
Route::get('runner-race/{id}', 'RunnerRaceController@findById');
Route::post('runner-race', 'RunnerRaceController@save');
Route::put('runner-race/{id}' , 'RunnerRaceController@update');
Route::delete('runner-race/{id}', 'RunnerRaceController@delete');

// CLASSIFICATION
Route::get('classification/all', 'ClassificationController@overallClassification'); 
Route::get('classfication/age', 'ClassificationController@classificationByAge');
