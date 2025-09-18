<?php
// public/listar.php
declare(strict_types=1);
require __DIR__ . '/../src/db.php';

$stmt = $pdo->query('SELECT id, nombre, correo, creado_en FROM public.persona ORDER BY id DESC');
$rows = $stmt->fetchAll();
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Listado de Personas</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>body{font-family:sans-serif;max-width:960px;margin:40px auto;padding:0 16px}table{border-collapse:collapse;width:100%}th,td{border:1px solid #ddd;padding:.6rem;text-align:left}th{background:#f6f6f6}nav a{margin-right:1rem}</style>
</head>
<body>
    <h1>Listado de Personas</h1>
    <nav>
    <a href="/">← Volver</a>
    </nav>
    <table>
    <thead>
        <tr><th>ID</th><th>Nombre</th><th>Correo</th><th>Creado</th></tr>
    </thead>
    <tbody>
        <?php if (!$rows): ?>
        <tr><td colspan="4">Sin registros.</td></tr>
        <?php else: ?>
        <?php foreach ($rows as $r): ?>
            <tr>
            <td><?= htmlspecialchars((string)$r['id']) ?></td>
            <td><?= htmlspecialchars($r['nombre']) ?></td>
            <td><?= htmlspecialchars($r['correo']) ?></td>
            <td><?= htmlspecialchars($r['creado_en']) ?></td>
            </tr>
        <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
    </table>
</body>
</html>
