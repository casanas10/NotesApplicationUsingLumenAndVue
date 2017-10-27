<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () {
    return view ("welcome");
});

$router->post('/login', 'AuthController@login');

$router->group(['middleware' => ['auth']], function() use ($router) {

	$router->get('/dashboard', function() {
		return response()->json('Hello World');
	});

	$router->get('/notes/{id}', 'NoteController@show');
	$router->post('/store', 'NoteController@store');
	$router->delete('/{id}', 'NoteController@deleteNote');
	$router->put('/{id}', 'NoteController@update');

});

