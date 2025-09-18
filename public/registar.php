<?php
// public/registrar.php
declare(strict_types=1);
require __DIR__ . '/../src/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: /');
    exit;
}

$nombre = trim($_POST['nombre'] ?? '');
$correo = trim($_POST['correo'] ?? '');

if ($nombre === '' || $correo === '') {
    header('Location: /?e=datos_incompletos');
    exit;
}

try {
    $stmt = $pdo->prepare('INSERT INTO public.persona (nombre, correo) VALUES (:nombre, :correo)');
    $stmt->execute([
    ':nombre' => $nombre,
    ':correo' => $correo,
    ]);
    header('Location: /listar.php?s=ok');
} catch (PDOException $e) {
  // Controla duplicado por unique correo u otros errores
    header('Location: /?e=error_registro');
  // Para debug local: echo $e->getMessage();
}
