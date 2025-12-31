<?php
require_once __DIR__.'/../config/db.php';

session_start();

$erros = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['email'], $_POST['password'])) {
    if(!empty(trim($_POST['email'])) && !empty(trim($_POST['password']))) {
      $email = $_POST['email'];
      $password = $_POST['password'];

      if (empty($errors)) {
        $stmt = $pdo->prepare('SELECT id, username, password FROM users WHERE email = :email LIMIT 1');
        $stmt->execute([':email' => $email]);
        $user = $stmt->fetch();

        if (!$user || !password_verify($password, $user['password'])) {
          $errors[] = 'credenciales incorrectas.';
        }
      }

      if (!empty($errors)) {
        $_SESSION['flash']['errors'] = $errors;
        header('Location: login.php', true, 303);
        exit();
      }

      $_SESSION['user'] = [
        'id' => $user['id'],
        'name' => $user['username'],
        'email' => $email
      ];

      header('Location: ../dashboard.php', true, 303);
      exit();
    } else {
      $errors[] = "Todos los campos son obligatorios.";
    }
  }
}

$flashErrors = $_SESSION['flash']['errors'] ?? [];
unset($_SESSION['flash']);
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <?php foreach ($flashErrors as $error): ?>
    <p style="color: red;"><?= htmlspecialchars($error) ?></p>
  <?php endforeach; ?>
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