<?php
namespace App\Controllers;

use App\Core\DB;
use MongoDB\BSON\ObjectId;

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

    public function editPlaceForm()
    {

        if (!isset($_SESSION['user'])) {
            header('Location: /login');
            exit;
        }

        $id = $_GET['id'] ?? null;
        if (!$id) {
            echo "ID inválido";
            exit;
        }

        $place = DB::db()->places->findOne([
            '_id'     => new ObjectId($id),
            'user_id' => $_SESSION['user']['id']
        ]);

         if (!$place) {
            echo "Lugar não encontrado.";
            exit;
        }

        $formData = [
            'name' => $place['name'] ?? '',
            'address' => $place['address'] ?? '',
            'date' => $place['date'] ?? '',
            'rating' => $place['rating'] ?? ''
        ];
        $errors = [];

        require dirname(__DIR__) . '/views/places/editPlace.php';

    }

    public function editPlace()
    {
        
        if (!isset($_SESSION['user'])) {
            header('Location: /login');
            exit;
        }

        $id = $_GET['id'] ?? null;
        if (!$id) {
            echo "ID inválido";
            exit;
        }

        $formData = [
            'name' => trim($_POST['name'] ?? ''),
            'address' => trim($_POST['address'] ?? ''),
            'date' => trim($_POST['date'] ?? ''),
            'rating' => trim($_POST['rating'] ?? '')
        ];

        $errors = [];
        if ($formData['name'] === '') $errors[] = "Nome é obrigatório";
        if ($formData['address'] === '') $errors[] = "Endereço é obrigatório";
        if ($formData['date'] === '') $errors[] = "Data é obrigatória";
        if ($formData['rating'] === '' || !is_numeric($formData['rating'])) {
            $errors[] = "Avaliação deve ser um número";
        }

        if (!empty($errors)) {
            require dirname(__DIR__) . '/views/editPlace.php';
            return;
        }

        DB::db()->places->updateOne(
            [
                '_id' => new ObjectId($id),
                'user_id' => $_SESSION['user']['id']
            ],
            ['$set' => $formData]
        );

        header('Location: /places');
        exit;
    }

    public function deletePlace(): void
    {
        if (!isset($_SESSION['user'])) {
            header('Location: /login');
            exit;
        }

        if (!isset($_GET['id']) || empty($_GET['id'])) {
            echo "ID inválido.";
            return;
        }

        try {
            $id = new ObjectId($_GET['id']);
        } catch (\Exception $e) {
            echo "ID inválido.";
            return;
        }

        $userId = $_SESSION['user']['id'];

        $result = DB::db()->places->deleteOne([
            '_id'    => $id,
            'user_id' => $userId 
        ]);

        if ($result->getDeletedCount() > 0) {
            header('Location: /places');
            exit;
        } else {
            echo "Erro ao excluir ou lugar não encontrado.";
        }
    }

}
