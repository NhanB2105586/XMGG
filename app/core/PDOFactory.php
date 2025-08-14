<?php

namespace App\Core;

use PDO;
use Dotenv\Dotenv;

class PDOFactory
{
    public function create(): PDO
    {
        $dotenv = Dotenv::createImmutable(__DIR__ . '/../../'); // Đảm bảo đường dẫn đúng
        $dotenv->load();

        $dbhost = $_ENV['DB_HOST'];
        $dbname = $_ENV['DB_NAME'];
        $dbuser = $_ENV['DB_USER'];
        $dbpass = $_ENV['DB_PASS'];

        $dsn = "mysql:host={$dbhost};dbname={$dbname};charset=utf8mb4";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci"
        ];
        return new PDO($dsn, $dbuser, $dbpass, $options);
    }
}
