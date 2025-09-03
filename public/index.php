<?php

require dirname(__DIR__) . '/vendor/autoload.php';
require dirname(__DIR__) . '/app/Core/bootstrap.php';

use App\Core\Router;
use App\Controllers\HomeController;
use App\Controllers\AuthController;

session_start();

$router = new Router();

// rota Home
$router->get('/', [new HomeController(), 'index']);

// Registro
$auth = new AuthController();
$router->get('/register ', [$auth, 'registerForm']);
$router->post('/register', [$auth, 'register']);
$router->get('/login',     [$auth, 'loginForm']);
$router->post('/login',    [$auth, 'login']);

$router->get('/places', function () {
    print_r($_SESSION);
});

$router->dispatch($_SERVER['REQUEST_METHOD'] ?? 'GET', $_SERVER['REQUEST_URI'] ?? '/');
