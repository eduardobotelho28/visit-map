<?php

require dirname(__DIR__) . '/vendor/autoload.php';
require dirname(__DIR__) . '/app/Core/bootstrap.php';

use App\Core\Router;
use App\Controllers\HomeController;
use App\Controllers\AuthController;
use App\Controllers\PlacesController;

$router = new Router();

// rota Home
$router->get('/', [new HomeController(), 'index']);

// Registro
$auth = new AuthController();
$router->get('/register ', [$auth, 'registerForm']);
$router->post('/register', [$auth, 'register']);
$router->get('/login',     [$auth, 'loginForm']);
$router->post('/login',    [$auth, 'login']);

//Places
$places = new PlacesController();
$router->get('/places', [$places, 'myPlaces']);
$router->get('/newPlace', [$places, 'newPlaceForm']);
$router->post('/newPlace', [$places, 'newPlace']);
$router->get('/editPlace', [$places, 'editPlaceForm']);     
$router->post('/editPlace', [$places, 'editPlace']);

$router->dispatch($_SERVER['REQUEST_METHOD'] ?? 'GET', $_SERVER['REQUEST_URI'] ?? '/');
