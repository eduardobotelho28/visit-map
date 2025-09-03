<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Registrar - Visit Map</title>
    <style>
        body {
            margin: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #ECBD7F 0%, #f5d9a1 100%);
        }
        .card {
            background: #FFEDC0;
            padding: 40px;
            border-radius: 12px;
            border: 4px solid #502B14;
            box-shadow: 0 6px 14px rgba(0,0,0,0.15);
            width: 350px;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #502B14;
        }
        .errors {
            color: #b00000;
            margin-bottom: 15px;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        input {
            margin-bottom: 15px;
            padding: 12px;
            border: 2px solid #502B14;
            border-radius: 8px;
            font-size: 1rem;
        }
        button {
            padding: 12px;
            background: #502B14;
            color: #ECBD7F;
            border: none;
            border-radius: 8px;
            font-weight: bold;
            font-size: 1rem;
            cursor: pointer;
        }
        button:hover {
            background: #6b3c1d;
        }
        .link {
            text-align: center;
            margin-top: 15px;
        }
        .link a {
            color: #502B14;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="card">
        <h2>Criar conta</h2>

        <?php if (!empty($errors ?? [])): ?>
            <div class="errors">
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?= htmlspecialchars($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form method="POST" action="/register">
            <input type="text" name="name" placeholder="Nome completo" value="<?= htmlspecialchars($formData['name'] ?? '') ?>">
            <input type="email" name="email" placeholder="E-mail" value="<?= htmlspecialchars($formData['email'] ?? '') ?>">
            <input type="password" name="password" placeholder="Senha">
            <button type="submit">Registrar</button>
        </form>
        <div class="link">
            Já tem conta? <a href="/login">Entrar</a>
        </div>
    </div>
</body>
</html>
