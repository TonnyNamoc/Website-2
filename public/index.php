<?php // public/index.php ?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Registro de Personas</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>body{font-family:sans-serif;max-width:720px;margin:40px auto;padding:0 16px}label{display:block;margin:.75rem 0 .25rem}input{width:100%;padding:.6rem}button{margin-top:1rem;padding:.6rem 1rem;cursor:pointer}nav a{margin-right:1rem}</style>
</head>
<body>
    <h1>Registro de Personas</h1>
    <nav>
    <a href="/listar.php">Ver lista</a>
    </nav>
    <form action="/registrar.php" method="post" autocomplete="off">
    <label for="nombre">Nombre *</label>
    <input id="nombre" name="nombre" required>

    <label for="correo">Correo *</label>
    <input id="correo" name="correo" type="email" required>

    <button type="submit">Registrar</button>
    </form>
</body>
</html>
