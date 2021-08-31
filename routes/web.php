<?php

/** @var \Laravel\Lumen\Routing\Router $router */

use Illuminate\Support\Facades\Auth;

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

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => '/api/v1', 'middleware' => 'auth'], function () use ($router) {
    $router->post('/blog', 'BlogController@store');
    $router->put('/blog/{id}', 'BlogController@update');
    $router->delete('/blog/{id}', 'BlogController@destroy');
    $router->get('/blogs', 'BlogController@index');
    $router->get('/blog/{id}', 'BlogController@show');
});
// $router->group(['prefix' => '/api/v1'], function () use ($router) {
//     $router->post('/blog', 'BlogController@store');
//     $router->put('/blog/{id}', 'BlogController@update');
//     $router->delete('/blog/{id}', 'BlogController@destroy');
//     $router->get('/blogs', 'BlogController@index');
//     $router->get('/blog/{id}', 'BlogController@show');
// });
