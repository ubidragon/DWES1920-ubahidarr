<?php
require_once("../includes/header.inc.php");
eliminarMovimientos()
?>
<h2>Eliminar Movimientos</h2>
<form action="eliminarMov.php" method="post">
        <input type="hidden" name="loginUser" value="<?php echo reloadUser();?>">
<?php
elementosEliminar();
?>
  <div class="container">        
    <button type="submit" name="eliminar">Eliminar movimientos</button>
  </div>
</form>
<?php
require_once '../includes/pie.php';
?>