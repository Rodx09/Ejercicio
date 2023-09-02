<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Acceso a registros</title>
  <link rel="stylesheet" href="css/login.css">

</head>
<?php
session_start();
if (isset($_SESSION['usuario'])) {
    header('location: index.php');
}
 ?>
<body>
<!-- partial:index.partial.html -->
<div class="login-page">
  <div class="form">
    <?php

include ("BD/database.php");
$clientes= new Database();

if(isset($_POST) && !empty($_POST)){
  $usuario = $clientes->limpiar($_POST['usuario']);
  $contra = $clientes->limpiar($_POST['contra']);
  $res = $clientes->login($usuario, $contra);

  }
?>
    <form method="post" class="login-form">
      <input type="text" name="usuario" id="usuario" placeholder="Usuario"/>
      <input type="password" name="contra" id="contra" placeholder="Contraseña"/>
      <button type="submit">Iniciar sesión</button>
    </form>
  </div>
</div>
<!-- partial -->
  <script  src="JS/script.js"></script>

</body>
</html>
