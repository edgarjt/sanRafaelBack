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
    return response()->json(['title' => 'Yeguada San Rafael', 'status' => 'active']);
});

//login
Route::post('login', 'UsersController@login');

//users
Route::get('getUsers', 'UsersController@getUsers')->name('getUsers');
Route::post('addUser', 'UsersController@addUser')->name('addUser');
Route::post('updateUser', 'UsersController@updateUser')->name('updateUser');
Route::post('deleteUser', 'UsersController@deleteUser')->name('deleteUser');
Route::post('passwordResset', 'UsersController@passwordResset')->name('passwordResset');

//Caballos
Route::get('getCaballos', 'CaballoController@getCaballos');
Route::get('ultimateCaballos', 'CaballoController@ultimateCaballos');
Route::post('whereCaballo', 'CaballoController@whereCaballo');
Route::post('addCaballo', 'CaballoController@addCaballo');
Route::post('updateCaballo', 'CaballoController@updateCaballo');
Route::post('deleteCaballo', 'CaballoController@deleteCaballo');

//Yeguas
Route::get('getYeguas', 'YeguaController@getYeguas');
Route::get('ultimateYeguas', 'YeguaController@ultimateYeguas');
Route::post('whereYegua', 'YeguaController@whereYegua');
Route::post('addYegua', 'YeguaController@addYegua');
Route::post('updateYegua', 'YeguaController@updateYegua');
Route::post('deleteYegua', 'YeguaController@deleteYegua');

//Fincas
Route::get('getFincas', 'FincaController@getFincas');
Route::post('addFinca', 'FincaController@addFinca');
Route::post('updateFinca', 'FincaController@updateFinca');
Route::post('deleteFinca', 'FincaController@deleteFinca');

//InfoWeb
Route::get('getInfos', 'InfowebController@getInfos');
Route::post('updateInfo', 'InfowebController@updateInfo');

//Sliders
Route::get('getSliders', 'SliderController@getSliders');
Route::post('updateSlider', 'SliderController@updateSlider');

//Reports
Route::get('reportPdf', 'UsersController@reportPdf')->name('reportPdf');
Route::get('reportYeguas', 'UsersController@reportYeguas')->name('reportYeguas');

//Trofeos Caballos
Route::get('getTrofeosCaballos', 'TrofeoController@getTrofeosCaballos');
Route::post('addTrofeoCaballo', 'TrofeoController@addTrofeoCaballo');
Route::post('whereTrofeoCaballo', 'TrofeoController@whereTrofeoCaballo');
Route::post('updateTrofeoCaballos', 'TrofeoController@updateTrofeoCaballos');
Route::post('deleteTrofeoCaballos', 'TrofeoController@deleteTrofeoCaballos');

//Trofeos Yeguas
Route::get('getTrofeosYeguas', 'TrofeoYeguaController@getTrofeosYeguas');
Route::post('addTrofeoYegua', 'TrofeoYeguaController@addTrofeoYegua');
Route::post('updateTrofeoYegua', 'TrofeoYeguaController@updateTrofeoYegua');
Route::post('whereTrofeoYegua', 'TrofeoYeguaController@whereTrofeoYegua');
Route::post('deleteTrofeoYegua', 'TrofeoYeguaController@deleteTrofeoYegua');

//Resources
Route::post('contacto', 'ResourcesController@contacto');
