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
    return $router->app->version();
});

$router->get('/users', 'UserController@index');
$router->post('/user', 'UserController@create');
$router->get('/user/{id}', 'UserController@show');
$router->put('/user/{id}', 'UserController@update');
$router->delete('/user/{id}', 'UserController@destroy');

$router->post('login', 'UserController@login');

$router->get('/messages', ['middleware'=>'auth','uses'=>'MessageController@index']);
$router->get('/messages/conversation/{recipient}', ['middleware'=>'auth','uses'=>'MessageController@showConversation']);

$router->post('/message',  ['middleware'=>'auth','uses'=>'MessageController@create']);
$router->get('/message/{id}',  ['middleware'=>'auth','uses'=>'MessageController@showOne']);
$router->put('/message/{id}',  ['middleware'=>'auth','uses'=>'MessageController@update']);
$router->delete('/message/{id}',  ['middleware'=>'auth','uses'=>'MessageController@destroy']);

