<?php
  session_start();

  require 'bd.php';

  if (isset($_SESSION['user_id'])) {
    $records = $conn->prepare('SELECT id, usuario, clave FROM usuarios WHERE id = :id');
    $records->bindParam(':id', $_SESSION['user_id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $user = null;

    if (count($results) > 0) {
      $user = $results;
    }
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>BIENVENIDO AL SITIO WEB</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
  </head>
  <body>
    <?php require 'partials/header.php' ?>

    <?php if(!empty($user)): ?>
      <br> Bienvenido. <?= $user['usuario']; ?>
      <br>Usted se ha conectado correctamente
      <a href="logout.php">
        Salir
      </a>
    <?php else: ?>
      <h1>Por favor Inicie Sesion o Registrese</h1>

      <a href="login.php">Iniciar Sesion</a> 
      <a href="signup.php">Registrarse</a>
    <?php endif; ?>
  </body>
</html>
