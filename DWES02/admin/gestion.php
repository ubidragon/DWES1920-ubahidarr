<?php
require_once("../includes/header.inc.php");
?>
<link rel="stylesheet" href="../css/custom.css">
<h2>Pantalla de Inicio</h2>
<p><i>Nombre de Usuario - Fecha y hora de la conexion</i></p>
<form>
  <div class="container">
    <button type="submit" formaction="usuario.php">Nuevo usuario</button>
    <button type="submit" formaction="invitado.php">Nuevo usuario<br/>precargado 1</button>     
    <button type="submit" formaction="invitado.php">Nuevo usuario<br/>precargado 2</button>     
    <button type="submit" formaction="usuario.php">Modificar usuario</button>
    <button type="submit" formaction="usuario.php">Borrar usuario</button>
    <button type="submit" formaction="usuario.php">Salir</button>
  </div>
</form>
<?php
require_once '../includes/pie.php';
?>