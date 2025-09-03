<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Meus Lugares - Visit Map</title>
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #ECBD7F 0%, #f5d9a1 100%);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        header {
            background: #502B14;
            color: #ECBD7F;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        header .user {
            font-weight: bold;
        }
        header .actions a {
            margin-left: 15px;
            padding: 8px 14px;
            background: #ECBD7F;
            color: #502B14;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
        }
        header .actions a:hover {
            background: #FFEDC0;
        }
        main {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            padding: 40px;
        }
        .card {
            background: #FFEDC0;
            border: 4px solid #502B14;
            border-radius: 12px;
            box-shadow: 0 6px 14px rgba(0,0,0,0.15);
            padding: 30px;
            width: 700px;
        }
        h2 {
            color: #502B14;
            margin-bottom: 20px;
            text-align: center;
        }
        .places-list {
            border: 2px dashed #502B14;
            border-radius: 10px;
            padding: 20px;
            min-height: 150px;
            display: flex;
            justify-content: center;
            align-items: center;
            background: #fff8e5;
        }
        .empty {
            color: #6b3c1d;
            font-style: italic;
        }
    </style>
</head>
<body>
    <header>
        <div class="user">Olá, <?= htmlspecialchars($_SESSION['user']['name']) ?> 👋</div>
        <div class="actions">
            <a href="/places/new">+ Novo Lugar</a>
            <a href="/logout">Sair</a>
        </div>
    </header>

    <main>
        <div class="card">
            <h2>Meus Lugares Visitados 🗺️</h2>

            <div class="places-list">
                <?php if (!empty($places)): ?>
                    <!-- Em breve: listagem bonita -->
                    <div>Aqui ficará a lista de lugares.</div>
                <?php else: ?>
                    <div class="empty">Você ainda não registrou nenhum lugar...</div>
                <?php endif; ?>
            </div>
        </div>
    </main>
    
</body>
</html>
