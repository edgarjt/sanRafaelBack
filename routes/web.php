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
Route::post('addCaballo', 'CaballoController@addCaballo');
Route::post('updateCaballo', 'CaballoController@updateCaballo');
Route::post('deleteCaballo', 'CaballoController@deleteCaballo');

//Yeguas
Route::get('getYeguas', 'YeguaController@getYeguas');
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
