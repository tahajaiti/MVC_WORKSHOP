<?php

use App\Core\Router;

$router = new Router();

$router->add('GET', '/', 'HomeController@index');

$router->add('GET', '/register', 'AuthController@register');
$router->add('POST', '/register', 'AuthController@register');

$router->add('GET', '/login', 'AuthController@login');
$router->add('POST', '/login', 'AuthController@login');

$router->dispatch();