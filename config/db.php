<?php

require_once __DIR__ . '/bootstrap.php';

$host = $_ENV['DB_HOST'];
$db_name = $_ENV['DB_NAME'];
$user = $_ENV['DB_USER'];
$password = $_ENV['DB_PASSWORD'];

try {
  $pdo = new PDO(
    "mysql:host=$host;dbname=$db_name;charset=utf8mb4",
    $user,
    $password,
    [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]
    );
} catch (PDOException $e) {
  die("Error de conexión a la base de datos: " . $e->getMessage());
}