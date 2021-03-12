<?php

/** @var \Laravel\Lumen\Routing\Router $router */

use App\Http\Controllers\HomeController;

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

$router->get('/', [
    'middleware' => 'basic.auth',
    'uses' => 'HomeController@index'
]);

$router->post('/', [
    'middleware' => 'basic.auth',
    'uses' => 'HomeController@index'
]);

$router->get('/status/{message_id}', [
    'middleware' => 'basic.auth',
    'uses' => 'HomeController@status'
]);

$router->get('/prtg/send', [
    'uses' => 'HomeController@send'
]);

$router->group(['namespace' => '\Rap2hpoutre\LaravelLogViewer', 'middleware' => 'basic.auth'], function () use ($router) {
    $router->get('logs', 'LogViewerController@index');
});
