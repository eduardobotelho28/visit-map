<?php
namespace App\Controllers;

class HomeController
{
    public function index(): string
    {
        ob_start();
        include dirname(__DIR__) . '/Views/home.php';
        return ob_get_clean();
    }
}
