<?php
  require_once __DIR__ . '/../config/db.php';

  $errors = [];

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['username'], $_POST['email'], $_POST['password'])) {
      if( empty(trim($_POST['username'])) || empty(trim($_POST['email'])) || empty(trim($_POST['password'])) ) {
        $errors[] = "Todos los campos son obligatorios.";
      }

      $username = $_POST['username'];
      $email = $_POST['email'];

      if (empty($errors)) {
        $stmt = $pdo->prepare('SELECT COUNT(*) FROM users WHERE email = :email');
        $stmt->execute([':email' => $email]);
        
        if ($stmt->fetchColumn() > 0) {
          $errors[] = "El email ya está registrado.";
        }
      }

      if (empty($errors)) {
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $stmt = $pdo->prepare('INSERT INTO users (username, email, password) VALUES (:username, :email, :password)');
        $stmt->execute([
          ':username' => $username,
          ':email' => $email,
          ':password' => $password
        ]);

        header('Location: login.php', true, 302);
        exit();
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
  <?php if (!empty($errors)): ?>
      <ul style="color: red;">
        <?php foreach ($errors as $error): ?>
          <li><?= htmlspecialchars($error) ?></li>
        <?php endforeach; ?>
      </ul>
  <?php endif; ?>
  <?php if ($success): ?>
      <p style="color: green;">Registro exitoso. <a href="login.php">Iniciar sesión</a></p>
  <?php endif; ?>
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