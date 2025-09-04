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

    public function newPlaceForm(): string
    {
        if (!isset($_SESSION['user'])) {
            header('Location: /login');
            exit;
        }

        ob_start();
        include dirname(__DIR__) . '/Views/places/newplace.php';
        return ob_get_clean();
    }

    public function newPlace(): string
    {
        if (!isset($_SESSION['user'])) {
            header('Location: /login');
            exit;
        }

        $name      = trim($_POST['name'] ?? '');
        $address   = trim($_POST['address'] ?? '');
        $date      = trim($_POST['date'] ?? '');
        $rating    = trim($_POST['rating'] ?? '');

        $errors = [];
        $formData = [
            'name'    => $name,
            'address' => $address,
            'date'    => $date,
            'rating'  => $rating
        ];

        if (!$name) $errors[] = "Preencha o nome do lugar.";
        if (!$address) $errors[] = "Preencha o endereço.";
        if (!$date) $errors[] = "Selecione a data da visita.";
        if ($rating === '' || !is_numeric($rating) || $rating < 0 || $rating > 10) {
            $errors[] = "A avaliação deve ser um número entre 0 e 10.";
        }

        if (!empty($errors)) {
            ob_start();
            include dirname(__DIR__) . '/Views/places/newplace.php';
            return ob_get_clean();
        }

        $collection = DB::db()->places;

        $collection->insertOne([
            'user_id'    => $_SESSION['user']['id'],
            'name'       => $name,
            'address'    => $address,
            'date'       => $date,
            'rating'     => (int)$rating,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        header('Location: /places');
        exit;
    }
}
