<?php
// src/db.php
declare(strict_types=1);

$host = getenv('PGHOST') ?: 'localhost';
$port = getenv('PGPORT') ?: '5432';
$db   = getenv('PGDATABASE') ?: 'postgres';
$user = getenv('PGUSER') ?: 'postgres';
$pass = getenv('PGPASSWORD') ?: '';

$dsn = "pgsql:host={$host};port={$port};dbname={$db};options='--client_encoding=UTF8'";

try {
    $pdo = new PDO($dsn, $user, $pass, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
} catch (PDOException $e) {
    http_response_code(500);
    echo "Error de conexión a la base de datos.";
  // En producción evita exponer el detalle:
  // echo $e->getMessage();
    
}
