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

// RUNNER 
Route::get('runner', 'RunnerController@list'); 
Route::get('runner/{id}', 'RunnerController@findById');
Route::post('runner', 'RunnerController@save');
Route::put('runner/{id}' , 'RunnerController@update');
Route::delete('runner/{id}', 'RunnerController@delete');

// PROOF TYPES
Route::get('proof-types', 'ProofTypesController@list'); 
Route::get('proof-types/{id}', 'ProofTypesController@findById');
Route::post('proof-types', 'ProofTypesController@save');
Route::put('proof-types/{id}' , 'ProofTypesController@update');
Route::delete('proof-types/{id}', 'ProofTypesController@delete');

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
