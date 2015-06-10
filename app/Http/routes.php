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

$app->get('/', function () use ($app)
{
    return $app->welcome();
});

$app->group(['prefix' => 'projects'], function ($app)
{
    $app->get('/', 'App\Http\Controllers\ProjectsController@index');
    $app->post('/', 'App\Http\Controllers\ProjectsController@store');
    $app->get('/{projectId}', 'App\Http\Controllers\ProjectsController@show');
    $app->put('/{projectId}', 'App\Http\Controllers\ProjectsController@update');
    $app->delete('{projectId}', 'App\Http\Controllers\ProjectsController@destroy');
});
