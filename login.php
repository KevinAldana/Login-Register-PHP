<?php

  session_start();

  if (isset($_SESSION['user_id'])) {
    header('Location: /php-login');
  }
  require 'bd.php';

  if (!empty($_POST['Usuario']) && !empty($_POST['Contraseña'])) {
    $records = $conn->prepare('SELECT id, usuario, clave FROM usuarios WHERE usuario = :usuario');
    $records->bindParam(':usuario', $_POST['Usuario']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $message = '';

    if (count($results) > 0 && password_verify($_POST['Contraseña'], $results['clave'])) {
      $_SESSION['user_id'] = $results['id'];
      header("Location: /php-login");
    } else {
      $message = 'Lo siento, Sus credenciales no coinciden';
    }
  }

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>INICIAR SESION</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
  </head>
  <body>
    <?php require 'partials/header.php' ?>

    <?php if(!empty($message)): ?>
      <p> <?= $message ?></p>
    <?php endif; ?>

    <h1>Iniciar Sesion</h1>
    <span> <a href="signup.php">Registrarse</a></span>

    <form action="login.php" method="POST">
    <i class="fa-solid fa-user"></i>
        <label for="Usuario">Usuario</label>
        <input type="text" name="Usuario" placeholder="Nombre de Usuario">

        <i class="fa-solid fa-unlock"></i>
        <label for="Contraseña">Contraseña</label>
        <input type="password" name="Contraseña" placeholder="Contraseña">
        <hr>
        <button type="submit">Iniciar Sesion </button>
        <a href="signup.php">Crear Cuenta</a>
    </form>
  </body>
</html>
