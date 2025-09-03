<?php

require dirname(__DIR__) . '/vendor/autoload.php';
require dirname(__DIR__) . '/app/Core/bootstrap.php';

use App\Core\Router;
use App\Controllers\HomeController;
use App\Controllers\AuthController;

$router = new Router();

// rota Home
$router->get('/', [new HomeController(), 'index']);

// Registro
$auth = new AuthController();
$router->get('/register', [$auth, 'registerForm']);
$router->post('/register', [$auth, 'register']);

$router->dispatch($_SERVER['REQUEST_METHOD'] ?? 'GET', $_SERVER['REQUEST_URI'] ?? '/');
