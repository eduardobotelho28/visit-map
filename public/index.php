<?php


require dirname(__DIR__) . '/vendor/autoload.php';
require dirname(__DIR__) . '/app/Core/bootstrap.php';


use App\Core\DB;


try {
$db = DB::db();
$db->command(['ping' => 1]);
echo "<h1>Visit Map — PHP + MongoDB</h1>";
echo "<p>Conexão OK com o banco: " . htmlspecialchars($db->getDatabaseName()) . "</p>";
echo "<p>Ambiente: " . htmlspecialchars($_ENV['APP_ENV'] ?? 'local') . "</p>";
} catch (Throwable $e) {
http_response_code(500);
echo "<h1>Falha de conexão</h1>";
echo "<pre>" . htmlspecialchars($e->getMessage()) . "</pre>";
}