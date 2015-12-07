<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::get('/', 'HomeController@index');
Route::get('home', 'HomeController@index');

Route::post('breeder/createAdmin', 'BreederController@createAdmin');
Route::get('breeder/{breeder}/{id}/edit', 'BreederController@edit');
Route::delete('species/destroy', 'SpeciesController@destroyResource');
Route::get('species/{id}/addImage', 'SpeciesController@imageAdd');
Route::post('species/addImage', 'SpeciesController@imageStore');   
Route::get('species/{id}/addNotes', 'SpeciesController@notesAdd');
Route::post('species/addNotes', 'SpeciesController@notesStore');


Route::resource('breeder' , 'BreederController', ['except' => ['edit']]);
Route::resource('species' , 'SpeciesController');

/*Route::get('breeder', 'BreederController@index');
Route::get('breeder/create', 'BreederController@create');
Route::get('breeder/{id}', 'BreederController@show');
Route::post('breeder', 'BreederController@store');

Route::get('species', 'SpeciesController@index');
Route::get('species/create', 'SpeciesController@create');
Route::get('species/{id}', 'SpeciesController@show');
Route::post('species', 'SpeciesController@store');*/

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);


Route::group(['prefix' => 'messages', 'before' => 'auth'], function () {
    Route::get('/', ['as' => 'messages', 'uses' => 'MessagesController@index']);
    Route::get('create', ['as' => 'messages.create', 'uses' => 'MessagesController@create']);
    Route::get('create/{id}', ['as' => 'messages.createSpecific', 'uses' => 'MessagesController@createSpecific']);
    Route::get('{id}/read', ['as' => 'messages.read', 'uses' => 'MessagesController@read']);
    Route::get('unread', ['as' => 'messages.unread', 'uses' => 'MessagesController@unread']);
    Route::post('/', ['as' => 'messages.store', 'uses' => 'MessagesController@store']);
    Route::get('{id}', ['as' => 'messages.show', 'uses' => 'MessagesController@show']);
    Route::put('{id}', ['as' => 'messages.update', 'uses' => 'MessagesController@update']);
});