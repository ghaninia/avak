<?php

/** @var \Laravel\Lumen\Routing\Router $router */

use App\Http\Controllers\Api\PollController;

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

$router->group([
    "prefix" => "api/pool" , 
    "namespace" => "Api"
], function ($router) {
    $router->get('/', ['uses' => 'PollController@index']);
    $router->post('/', ['uses' => 'PollController@store']);
});
