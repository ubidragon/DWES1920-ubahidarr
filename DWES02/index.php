<?php
require_once("./includes/funciones.inc.php");
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body> 
<?php
login();
?>
<link rel="stylesheet" href="./css/custom.css">
<h2>Pantalla de Inicio</h2>
<form action="index.php" method="post">
  <div class="container">
    <label for="loginUser"><b>Usuario</b></label>
    <input type="text" placeholder="Introduzca usuario" name="loginUser" required>

    <label for="password"><b>Contraseña</b></label>
    <input type="password" placeholder="Introduzca Contraseña" name="password" required>
        
    <button type="submit">Acceder como Usuario</button>
  </div>
</form>
<form>
  <div class="container">        
    <button type="submit" formaction="./admin/acceso.php">Acceder como Administrador</button>
  </div>
</form>
<?php
require_once './includes/pie.php';
?>