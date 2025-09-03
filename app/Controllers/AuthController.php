<?php
namespace App\Controllers;

use App\Core\DB;

class AuthController
{
    
    public function registerForm()
    {
        ob_start();
        include dirname(__DIR__) . '/Views/auth/register.php';
        return ob_get_clean();
    }

    public function loginForm(): string
    {
        ob_start();
        include dirname(__DIR__) . '/Views/auth/login.php';
        return ob_get_clean();
    }

    public function register(): string
    {
        $name  = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';
        $pass  = $_POST['password'] ?? '';

        $errors = [];

        if (!$name)  $errors[] = 'Preencha o nome completo.';
        if (!$email) $errors[] = 'Preencha o e-mail.';
        if (!$pass)  $errors[] = 'Preencha a senha.';

        $collection = DB::db()->users;

        if ($email && $collection->findOne(['email' => $email])) {
            $errors[] = 'Email já cadastrado.';
        }

        if (!empty($errors)) {
            // repassa erros e valores para a view
            $formData = ['name' => $name, 'email' => $email];
            ob_start();
            include dirname(__DIR__) . '/Views/auth/register.php';
            return ob_get_clean();
        }

        $hash = password_hash($pass, PASSWORD_BCRYPT);

        $collection->insertOne([
            'name'       => $name,
            'email'      => $email,
            'password'   => $hash,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        // registro concluído, redirecionar para login
        header('Location: /login');
        exit;
    }

    public function login(): string
    {
        $email = $_POST['email'] ?? '';
        $pass  = $_POST['password'] ?? '';

        $errors = [];

        if (!$email) $errors[] = 'Preencha o e-mail.';
        if (!$pass)  $errors[] = 'Preencha a senha.';

        $collection = DB::db()->users;
        $user = $email ? $collection->findOne(['email' => $email]) : null;

        if (!$errors && (!$user || !password_verify($pass, $user['password']))) {
            $errors[] = 'E-mail ou senha inválidos.';
        }

        if (!empty($errors)) {
            $formData = ['email' => $email];
            ob_start();
            include dirname(__DIR__) . '/Views/auth/login.php';
            return ob_get_clean();
        }

        // guardar dados básicos em sessão
        $_SESSION['user'] = [
            'id'    => (string)$user['_id'],
            'name'  => $user['name'],
            'email' => $user['email']
        ];

        header('Location: /places');
        exit;
    }

}
