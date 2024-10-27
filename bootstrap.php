<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
define('ROOTDIR', __DIR__ . DIRECTORY_SEPARATOR);

require_once ROOTDIR . 'vendor/autoload.php';


$dotenv = Dotenv\Dotenv::createImmutable(ROOTDIR);
$dotenv->load();

try {
    $PDO = (new App\Models\PDOFactory())->create([
        'dbhost' => $_ENV['DB_HOST'],
        'dbname' => $_ENV['DB_NAME'],
        'dbuser' => $_ENV['DB_USER'],
        'dbpass' => $_ENV['DB_PASS'],
    ]);
} catch (Exception $ex) {
    echo 'Không thể kết nối đến MySQL,
		kiểm tra lại username/password đến MySQL.<br>';
}
