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
