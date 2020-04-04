<?php
require_once("../includes/header.inc.php");
?>
<h2>Panel de administracion</h2>
<form>
<input type="hidden" name="admin" value="<?php echo reloadAdmin(); ?>">
  <div class="container">
    <button type="submit" formmethod="post" formaction="<?php echo $uri.'admin/nuevoUsuario.php'; ?>">Nuevo usuario</button>
    <button type="submit" formmethod="post" formaction="<?php echo $uri.'admin/nuevoUsuario.php?name=prueba1&newLogin=1&pass=1&checkPass=1&fechaNacimiento=2001-01-01&presupuesto=5'; ?>">Nuevo usuario<br/>precargado 1</button>     
    <button type="submit" formmethod="post" formaction="<?php echo $uri.'admin/nuevoUsuario.php?name=Pedro Español&newLogin=pedroProduccion&pass=abc123&checkPass=abc123&fechaNacimiento=1994-02-21&presupuesto=455550'; ?>">Nuevo usuario<br/>precargado 2</button>     
    <button type="submit" formmethod="post" formaction="<?php echo $uri.'admin/modificaUsuario.php'; ?>">Modificar usuario</button>
    <button type="submit" formmethod="post" formaction="<?php echo $uri.'admin/borraUsuario.php'; ?>">Borrar usuario</button>
    <button type="submit" formmethod="post" formaction="<?php echo $uri;?>">Salir</button>
  </div>
</form>
<?php
require_once '../includes/pie.php';
?>