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

Route::get('/', 'HomeController@index')->name('home');
Route::get('/my', 'HomeController@myindex')->name('home.my');

Route::prefix('note')->group(function() {
	//GET:
	Route::get('/addnote', 'NotesController@index')->name('note');
	//Route::get('/drop', 'NotesController@drop');
	Route::get('/del/{id}', 'NotesController@delnotes')->name('note.del');
	Route::get('/like/{id}', 'NotesController@checkLike')->name('note.like');
	Route::get('/edit/{id}', 'NotesController@editnotes')->name('note.edit');

	//POST:
	Route::post('/add', 'NotesController@addnotes')->name('note.add');
	Route::post('/edit', 'NotesController@editnotessubm')->name('note.edit.submit');

});

Route::prefix('task')->group(function() {
	//GET:
	Route::get('/list', 'TasksController@index')->name('task');
	Route::get('/addtask', 'TasksController@add')->name('task.add');


	//POST:

});

Auth::routes();
