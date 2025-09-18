<?php
declare(strict_types=1);

$pdo = null;

// 1) Preferir DATABASE_URL (Private/Public Network de Railway)
$databaseUrl = getenv('DATABASE_URL');

if ($databaseUrl) {
  // Espera algo como: postgresql://user:pass@host:port/dbname?sslmode=require
  $parts = parse_url($databaseUrl);

  $host = $parts['host'] ?? 'localhost';
  $port = $parts['port'] ?? '5432';
  $db   = isset($parts['path']) ? ltrim($parts['path'], '/') : 'postgres';
  $user = isset($parts['user']) ? urldecode($parts['user']) : '';
  $pass = isset($parts['pass']) ? urldecode($parts['pass']) : '';

  // Lee parámetros extra (sslmode, etc.)
  $query = [];
  if (!empty($parts['query'])) parse_str($parts['query'], $query);
  $sslmode = $query['sslmode'] ?? null;

  $dsn = "pgsql:host={$host};port={$port};dbname={$db}";
  if ($sslmode) $dsn .= ";sslmode={$sslmode}";

} else {
  // 2) Fallback: variables sueltas
  $host = getenv('PGHOST') ?: 'localhost';
  $port = getenv('PGPORT') ?: '5432';
  $db   = getenv('PGDATABASE') ?: 'postgres';
  $user = getenv('PGUSER') ?: 'postgres';
  $pass = getenv('PGPASSWORD') ?: '';
  $dsn  = "pgsql:host={$host};port={$port};dbname={$db}";
}

try {
  $pdo = new PDO($dsn, $user, $pass, [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
  ]);
} catch (PDOException $e) {
  http_response_code(500);
  echo "Error de conexión a la base de datos.";
  exit;
}
