<?Php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('json/getentries', 'JsonController@getEntries');
Route::get('json/saveentry', 'JsonController@postSaveEntry');
Route::post('json/saveentry', 'JsonController@postSaveEntry');
Route::post('json/deleteentry', 'JsonController@postDeleteEntry');

Route::get('ajax/getentries', 'AjaxController@getEntries');
Route::get('ajax/loadeditor', 'AjaxController@postLoadEditor');
Route::post('ajax/loadeditor', 'AjaxController@postLoadEditor');

Route::controller('users', 'UsersController');


Route::get('/terms', function() { return View::make('terms'); });
Route::get('/privacy', function() { return View::make('privacy'); });
Route::get('/features', function() { return View::make('features'); });
Route::get('/about', function() { return View::make('about'); });
Route::get('/', function(){	return View::make('landing'); });