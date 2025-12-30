<?php
require_once __DIR__.'/../config/db.php';

session_start();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['email'], $_POST['password'])) {
    if(!empty(trim($_POST['email'])) && !empty(trim($_POST['password']))) {
      $email = $_POST['email'];
      $password = $_POST['password'];

      $stmt = $pdo->prepare('SELECT id, name, password FROM users WHERE email = :email');
      $stmt->execute([':email' => $email]);
      $user = $stmt->fetch();

      
    }
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
    <label for="email">email:</label>
    <input type="email" id="email" name="email" required>
    <br><br>
    <label for="password">Contraseña</label>
    <input type="password" id="password" name="password" required>
    <br><br>
    <input type="submit" value="Iniciar sesión">
  </form>
  <br>
  <a href="register.php">Registrarse</a>
</body>
</html>