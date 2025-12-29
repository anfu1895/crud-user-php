<?php
  require_once __DIR__ . '/../config/db.php';

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['username'], $_POST['email'], $_POST['password'])) {
      if( empty(trim($_POST['username'])) || empty(trim($_POST['email'])) || empty(trim($_POST['password'])) ) {
        die("Por favor, complete todos los campos.");
      }

      $username = $_POST['username'];
      $email = $_POST['email'];
      $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

      $stmt = $pdo->prepare('SELECT COUNT(*) FROM users WHERE email = :email');
      $stmt->execute([':email' => $_POST['email']]);
      if ($stmt->fetchColumn() > 0) {
        die("El email ya está registrado.");
      }

      $stmt = $pdo->prepare('INSERT INTO users (username, email, password) VALUES (:username, :email, :password)');
      $stmt->execute([
        ':username' => $username,
        ':email' => $email,
        ':password' => $password
      ]);

      echo "Usuario registrado con éxito.";
    }
  }
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <form action="" method="post">

    <label for="username">Nombre de usuario:</label>
    <input type="text" id="username" name="username" required>
    <br><br>
    <label for="email">Email</label>
    <input type="email" id="email" name="email" required>
    <br><br>
    <label for="password">Contraseña</label>
    <input type="password" id="password" name="password" required>
    <br><br>
    <input type="submit" value="Registrarse">
  </form>
  
</body>
</html>