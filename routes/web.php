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

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function ($api) {
    $api->get('users', 'App\Http\Controllers\UserController@list');
    $api->get('users/{userId}', 'App\Http\Controllers\UserController@get');
    $api->post('users', 'App\Http\Controllers\UserController@create');
    $api->delete('users/{userId}', 'App\Http\Controllers\UserController@delete');
    $api->patch('users/{userId}', 'App\Http\Controllers\UserController@update');
});
