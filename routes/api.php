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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

// Registra
Route::post('register', 'Auth\RegisterController@create');
// Login
Route::post('login', 'Auth\LoginController@login');
// Logout
Route::post('logout', 'Auth\LoginController@logout');


// API protette
//Route::group(['middleware' => 'auth:api'], function () {
//
//
//// Standard API per users
//Route::get('getutenti', 'UserController@getall');
//Route::get('getutente/{id}', 'UserController@getById');
//Route::get('utente/{id}/getindirizzo', 'UserController@getindirizzo');
//Route::post('inserisci-utente', 'UserController@create');
//Route::post('modifica-utente', 'UserController@update');
//Route::post('elimina-utente', 'UserController@delete');
//
//// Standard API per indirizzo
//Route::get('getindirizzi', 'IndirizzoController@getall');
//Route::get('getindirizzo/{id}', 'IndirizzoController@getById');
////Route::get('indirizzo/{id}/getrelated/{type}', 'IndirizzoController@getrelated');
//Route::post('inserisci-indirizzo', 'IndirizzoController@create');
//Route::post('modifica-indirizzo', 'IndirizzoController@update');
//Route::post('elimina-indirizzo', 'IndirizzoController@delete');
//});

Route::group(['middleware' => 'auth:api'], function () {
// Standard API per users
Route::get('utenti', 'UserController@getall');
Route::get('utente/{id}', 'UserController@getById');
Route::get('utente/{id}/getindirizzo', 'UserController@getindirizzo');
Route::post('inserisci-utente', 'UserController@create');
Route::post('modifica-utente', 'UserController@update');
Route::post('elimina-utente', 'UserController@delete');

Route::get('/media-rate/utente/{id}','UserController@rateById');

// Standard API per indirizzo
Route::get('indirizzi', 'IndirizzoController@getall');
Route::get('indirizzo/{id}', 'IndirizzoController@getById');
//Route::get('indirizzo/{id}/getrelated/{type}', 'IndirizzoController@getrelated');
Route::post('inserisci-indirizzo', 'IndirizzoController@create');
Route::post('modifica-indirizzo', 'IndirizzoController@update');
Route::post('elimina-indirizzo', 'IndirizzoController@delete');
Route::get('indirizzo/{id}/getcomune/', 'IndirizzoController@getcomune');
Route::get('indirizzo/{id}/getprovincia/', 'IndirizzoController@getprovincia');
Route::get('indirizzo/{id}/getregione/', 'IndirizzoController@getregione');


// Standard API per recensione
Route::get('/recensioni','RecensioneController@allRec');

Route::get('/recensione/{id}','RecensioneController@getById');

Route::post('/inserisci-recensione','RecensioneController@newRec');

Route::post('/modifica-recensione','RecensioneController@modificaRecensione');

Route::post('/elimina-recensione','RecensioneController@eliminaRecensione');

Route::get('/recensioni/inserzione/{id}','RecensioneController@getByIdRecensable');

Route::get('/recensioni/utente/{id}', 'RecensioneController@getByIdUtente');


// Standard API per inserzione
Route::get('/inserzioni', 'InserzioneController@inserzioni');

Route::get('/inserzione/{id}', 'InserzioneController@inserzione');

Route::post('/inserisci-inserzione', 'InserzioneController@inseriscinserzione');

Route::post('/modifica-inserzione', 'InserzioneController@modificainserzione');

Route::post('/elimina-inserzione', 'InserzioneController@eliminainserzione');

Route::get('/inserzioni/{tipo}', 'InserzioneController@inserzionebytipo');

Route::get('/media-rate/inserzione/{id}','InserzioneController@rateById');

Route::get('/inserzioni-user/{iduser}','InserzioneController@inserzionibyuser');

// Standard API per avvistamento

    Route::get('/avvistamenti', 'AvvistamentoController@avvistamenti');

    Route::get('/avvistamento/{id}', 'AvvistamentoController@avvistamento');

    Route::get('/avvistamenti/{idinserzione}','AvvistamentoController@avvistamentibyinserzione');

    Route::post('/inserisci-avvistamento', 'AvvistamentoController@inserisciavvistamento');

    Route::post('/modifica-avvistamento', 'AvvistamentoController@modificaavvistamento');

    Route::post('/elimina-avvistamento', 'AvvistamentoController@eliminaavvistamento');

    Route::get('/avvistamenti/{idinserzione}','AvvistamentoController@avvistamentibyinserzione');




});


//// Standard API per users
//Route::get('utenti', 'UserController@getall');
//Route::get('utente/{id}', 'UserController@getById');
//Route::get('utente/{id}/getindirizzo', 'UserController@getindirizzo');
//Route::post('inserisci-utente', 'UserController@create');
//Route::post('modifica-utente', 'UserController@update');
//Route::post('elimina-utente', 'UserController@delete');
//
//// Standard API per indirizzo
//Route::get('indirizzi', 'IndirizzoController@getall');
//Route::get('indirizzo/{id}', 'IndirizzoController@getById');
////Route::get('indirizzo/{id}/getrelated/{type}', 'IndirizzoController@getrelated');
//Route::post('inserisci-indirizzo', 'IndirizzoController@create');
//Route::post('modifica-indirizzo', 'IndirizzoController@update');
//Route::post('elimina-indirizzo', 'IndirizzoController@delete');
//Route::get('indirizzo/{id}/getcomune/', 'IndirizzoController@getcomune');
//Route::get('indirizzo/{id}/getprovincia/', 'IndirizzoController@getprovincia');
//Route::get('indirizzo/{id}/getregione/', 'IndirizzoController@getregione');
//
//
//// Standard API per recensione
//Route::get('/recensioni', 'RecensioneController@allRec');
//
//Route::get('/recensione/{id}', 'RecensioneController@getById');
//
//Route::post('/inserisci-recensione', 'RecensioneController@newRec');
//
//Route::post('/modifica-recensione', 'RecensioneController@modificaRecensione');
//
//Route::post('/elimina-recensione', 'RecensioneController@eliminaRecensione');
//
//Route::get('/recensioni/inserzione/{id}', 'RecensioneController@getByIdRecensable');
//
//Route::get('/recensioni/utente/{id}', 'RecensioneController@getByIdUtente');
//
//
//// Standard API per inserzione
//Route::get('/inserzioni', 'InserzioneController@inserzioni');
//
//Route::get('/inserzione/{id}', 'InserzioneController@inserzione');
//
//Route::post('/inserisci-inserzione', 'InserzioneController@inseriscinserzione');
//
//Route::post('/modifica-inserzione', 'InserzioneController@modificainserzione');
//
//Route::post('/elimina-inserzione', 'InserzioneController@eliminainserzione');
//
//Route::get('/inserzioni/{tipo}', 'InserzioneController@inserzionebytipo');
//
//// Standard API
