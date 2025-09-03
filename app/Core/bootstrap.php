<?php

use Dotenv\Dotenv;

$root = dirname(__DIR__, 2);
if (file_exists($root . '/.env')) {
    $dotenv = Dotenv::createImmutable($root);
    $dotenv->load();
}


session_name($_ENV['SESSION_NAME'] ?? 'VISITMAPSESS');
session_start([
    'cookie_httponly' => true,
    'cookie_secure'   => false,
    'cookie_samesite' => 'Lax',
]);


function envv(string $key, $default = null) {
    return $_ENV[$key] ?? $default;
}