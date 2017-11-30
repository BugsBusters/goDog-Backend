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
Route::get('/recensioni','RecensioneController@allRec');

Route::get('/recensione/{id}','RecensioneController@getById');

Route::post('/inserisci-recensione','RecensioneController@newRec');

Route::post('/modifica-recensione','RecensioneController@modificaRecensione');

Route::post('/elimina-recensione','RecensioneController@eliminaRecensione');

Route::get('/allrecensioni/{id}','RecensioneController@getByIdRecensable');



Route::get('/inserzioni', 'InserzioneController@inserzioni');

Route::get('/inserzione/{id}', 'InserzioneController@inserzione');

Route::post('/inserisci-inserzione', 'InserzioneController@inseriscinserzione');

Route::post('/modifica-inserzione', 'InserzioneController@modificainserzione');

Route::post('/elimina-inserzione', 'InserzioneController@eliminainserzione');
