<?php

namespace App\Core;

use PDO;
use Dotenv\Dotenv;

class PDOFactory
{
    public function create(): PDO
    {
        // Sử dụng environment variables đã được set từ bootstrap.php
        $dbhost = $_ENV['DB_HOST'] ?? 'localhost';
        $dbname = $_ENV['DB_NAME'] ?? 'project';
        $dbuser = $_ENV['DB_USER'] ?? 'root';
        $dbpass = $_ENV['DB_PASS'] ?? '';

        $dsn = "mysql:host={$dbhost};dbname={$dbname};charset=utf8";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
        ];
        return new PDO($dsn, $dbuser, $dbpass, $options);
    }
}
