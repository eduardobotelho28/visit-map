<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Visit Map</title>
    <style>
        body {
            margin: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #ECBD7F;
            background-image: radial-gradient(#d9b36c 1px, transparent 1px),
                              radial-gradient(#d9b36c 1px, transparent 1px);
            background-size: 20px 20px;
            background-position: 0 0, 10px 10px;
        }
        .container {
            text-align: center;
            background: #FFEDC0;
            padding: 50px 60px;
            border-radius: 20px;
            border: 6px solid #502B14;
            box-shadow: 0 8px 18px rgba(0,0,0,0.2);
            max-width: 650px;
            position: relative;
        }
        h1 {
            font-size: 3rem;
            margin-bottom: 20px;
            color: #502B14;
            letter-spacing: 2px;
        }
        p {
            font-size: 1.1rem;
            color: #3d2a1a;
            margin-bottom: 30px;
            line-height: 1.6;
        }
        a {
            display: inline-block;
            margin: 10px;
            padding: 14px 28px;
            background: #502B14;
            color: #ECBD7F;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
            font-size: 1rem;
            transition: all 0.2s ease;
        }
        a:hover {
            background: #6b3c1d;
            color: #fff4da;
        }
        /* Ícones decorativos */
        .icon {
            font-size: 2rem;
            position: absolute;
            opacity: 0.40;
        }
        .icon.map-pin { top: 15px; left: 20px; }
        .icon.plane { bottom: 20px; right: 25px; font-size: 2.5rem; }
    </style>
</head>
<body>
    <div class="container">
        <span class="icon map-pin">📍</span>
        <span class="icon plane">✈️</span>
        <h1>Visit Map</h1>
        <p>
            Organize suas aventuras em um só lugar!  
            No <strong>Visit Map</strong> você pode registrar cada destino visitado, incluindo país, estado, cidade, data da visita, notas pessoais, avaliação e muito mais.  
            Acompanhe sua jornada, relembre memórias e planeje as próximas viagens com estilo.
        </p>
        <a href="/login">Entrar</a>
        <a href="/register">Registrar</a>
    </div>
</body>
</html>
