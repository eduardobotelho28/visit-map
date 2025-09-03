<?php
namespace App\Controllers;

use App\Core\DB;

class PlacesController
{
    public function myPlaces(): string
    {
        if (!isset($_SESSION['user'])) {
            header('Location: /login');
            exit;
        }

        $collection = DB::db()->places;
        $userId = $_SESSION['user']['id'];

        $places = $collection->find(['user_id' => $userId])->toArray();

        ob_start();
        include dirname(__DIR__) . '/Views/places/myplaces.php';
        return ob_get_clean();
    }
}
