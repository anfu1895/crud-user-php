<?php

require_once __DIR__ . '/auth/auth.php';
require_once __DIR__ . '/config/db.php';

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <h1>Bienvenido al Dashboard</h1>
  <p>Usuario: <?= htmlspecialchars($_SESSION['user']['name']) ?></p>
  <a href="./auth/logout.php">Cerrar sesión</a>
</body>
</html>

