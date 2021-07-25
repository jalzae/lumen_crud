<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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
    $data = [
        "message" => "Connected",
        "status" => 200,
    ];
    print_r(json_encode($data));
});

$router->post('/login', "User@login");
$router->post('/test', "User@test");

///fix
$router->get('/barang', "Product@index");
$router->get('/barang/{id}', "Product@detail");
$router->post('/barang', "Product@insert");
$router->put('/barang/{id}', "Product@update");
$router->delete('/barang/{id}', "Product@delete");
