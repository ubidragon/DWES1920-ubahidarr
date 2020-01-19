<?php
require_once("../includes/header.inc.php");
?>
<h2>Panel de administracion</h2>
<form>
<input type="hidden" name="admin" value="<?php echo reloadAdmin(); ?>">
  <div class="container">
    <button type="submit" formaction="<?php echo $uri.'admin/nuevoUsuario.php'; ?>">Nuevo usuario</button>
    <button type="submit" formaction="<?php echo $uri.'admin/nuevoUsuario.php'; ?>">Nuevo usuario<br/>precargado 1</button>     
    <button type="submit" formaction="<?php echo $uri.'admin/nuevoUsuario.php'; ?>">Nuevo usuario<br/>precargado 2</button>     
    <button type="submit" formaction="<?php echo $uri.'admin/modificaUsuario.php'; ?>">Modificar usuario</button>
    <button type="submit" formaction="<?php echo $uri.'admin/borrausuario.php'; ?>">Borrar usuario</button>
    <button type="submit" formaction="<?php echo $uri;?>">Salir</button>
  </div>
</form>
<?php
require_once '../includes/pie.php';
?>