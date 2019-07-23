<?php


$router->get('/', function () use ($router) {
    return " Innosabi. ";
});

$router->post('auth/login', ['uses' => 'AuthController@authenticate']);

$router->group(['middleware' => 'jwt.auth', 'prefix' => 'api'], function() use ($router) {
    $router->get('projects',  ['uses' => 'ProjectController@showProjects']);
    $router->get('projects/{id}', ['uses' => 'ProjectController@showOneProject']);
    $router->post('projects', ['uses' => 'ProjectController@create']);
    $router->delete('projects/{id}', ['uses' => 'ProjectController@delete']);
    $router->put('projects/{id}', ['uses' => 'ProjectController@update']);
});