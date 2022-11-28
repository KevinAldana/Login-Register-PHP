<?php

  require 'bd.php';

  $message = '';

  if (!empty($_POST['Usuario']) && !empty($_POST['Contraseña'])) {
    $sql = "INSERT INTO usuarios (usuario, clave, fecha_creacion) VALUES (:usuario, :clave, :fecha_creacion)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':usuario', $_POST['Usuario']);
    $password = password_hash($_POST['Contraseña'], PASSWORD_BCRYPT);
    $stmt->bindParam(':clave', $password);
    $stmt->bindParam(':fecha_creacion', $_POST['fecha']);
    

    if ($stmt->execute()) {
      $message = 'Usuario Creado Correctamente';
    } else {
      $message = 'Lo siento ha ocurrido un error creando una contraseña';
    }
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Registro</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
  </head>
  <body>

    <?php require 'partials/header.php' ?>

    <?php if(!empty($message)): ?>
      <p> <?= $message ?></p>
    <?php endif; ?>

    <h1>Registrarse</h1>
    <span>  <a href="login.php">Inicie Sesion</a></span>

    <form action="signup.php" method="POST">
    <label for="User">Nombre de Usuario</label>
    <input type="text" name="Usuario" id="user" placeholder="Nombre de usuario">
    <label for="password">Contraseña</label>
    <input type="password" name="Contraseña" id="pass" placeholder="Contraseña">
    <label for="confirm_password">Confirmar Contraseña</label>
    <input name="confirm_password" type="password" placeholder="Confirmar Contraseña">
    <label for="fecha de registro"> Fecha de Registro</label>
    <input type="date" name="fecha" id="fecha" placeholder="Fecha">
    <input type="submit" value="Enviar">
    </form>

  </body>
</html>
