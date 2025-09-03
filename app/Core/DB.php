<?php


namespace App\Core;


use MongoDB\Client;
use MongoDB\Database;


class DB
{
private static ?Client $client = null;
private static ?Database $db = null;


public static function client(): Client
{
if (!self::$client) {
$uri = $_ENV['MONGODB_URI'] ?? 'mongodb://localhost:27017';
self::$client = new Client($uri);
}
return self::$client;
}


public static function db(): Database
{
if (!self::$db) {
$name = $_ENV['MONGODB_DB'] ?? 'visitmap';
self::$db = self::client()->selectDatabase($name);
}
return self::$db;
}
}