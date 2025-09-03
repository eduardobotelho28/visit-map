<?php
namespace App\Controllers;

use App\Core\DB;

class AuthController
{
    // Mostra o formulário de registro
    public function registerForm()
    {
        echo 'aqui';
    }

    // Processa o registro
    public function register(): string
    {
        $name  = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';
        $pass  = $_POST['password'] ?? '';

        if (!$name || !$email || !$pass) {
            return "<p>Preencha todos os campos. <a href='/public/register'>Voltar</a></p>";
        }

        $collection = DB::db()->users;

        // Verifica se já existe
        $exists = $collection->findOne(['email' => $email]);
        if ($exists) {
            return "<p>Email já cadastrado. <a href='/public/register'>Voltar</a></p>";
        }

        // Hash da senha
        $hash = password_hash($pass, PASSWORD_BCRYPT);

        // Inserir usuário
        $collection->insertOne([
            'name'       => $name,
            'email'      => $email,
            'password'   => $hash,
            'created_at' => date('Y-m-d H:i:s') // data como string
        ]);

        return "<p>Usuário registrado com sucesso! <a href='/public/login'>Fazer login</a></p>";
    }
}
