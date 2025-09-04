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
            background: #fff8e5;
        }
        .place-item {
            background: #fff;
            border: 2px solid #502B14;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .place-details {
            flex: 1;
        }
        .place-details strong {
            color: #502B14;
        }
        .place-actions a {
            margin-left: 10px;
            padding: 6px 12px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: bold;
        }
        .place-actions .edit {
            background: #2ECC71;
            color: #fff;
        }
        .place-actions .edit:hover {
            background: #27ae60;
        }
        .place-actions .delete {
            background: #e74c3c;
            color: #fff;
        }
        .place-actions .delete:hover {
            background: #c0392b;
        }
        .empty {
            color: #6b3c1d;
            font-style: italic;
            text-align: center;
        }
    </style>
</head>
<body>
    <header>
        <div class="user">Olá, <?= htmlspecialchars($_SESSION['user']['name']) ?> 👋</div>
        <div class="actions">
            <a href="/newPlace">+ Novo Lugar</a>
            <a href="/logout">Sair</a>
        </div>
    </header>

    <main>
        <div class="card">
            <h2>Meus Lugares Visitados 🗺️</h2>

            <div class="places-list">
                <?php if (!empty($places)): ?>
                    <?php foreach ($places as $place): ?>
                        <div class="place-item">
                            <div class="place-details">
                                <strong><?= htmlspecialchars($place['name']) ?></strong><br>
                                📍 <?= htmlspecialchars($place['address']) ?><br>
                                📅 <?= htmlspecialchars($place['date']) ?><br>
                                ⭐ Avaliação: <?= htmlspecialchars($place['rating']) ?>/10
                            </div>
                            <div class="place-actions">
                                <a href="/editPlace?id=<?= $place['_id'] ?>" class="edit">Editar</a>
                                <a href="/deletePlace?id=<?= $place['_id'] ?>" class="delete" onclick="return confirm('Tem certeza que deseja excluir este lugar?');">Excluir</a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="empty">Você ainda não registrou nenhum lugar...</div>
                <?php endif; ?>
            </div>
        </div>
    </main>
    
</body>
</html>
