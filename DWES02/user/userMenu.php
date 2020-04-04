<?php
require("../includes/header.inc.php");

?>

<h2>Pantalla de Inicio</h2>

<form>
<input type="hidden" name="loginUser" value="<?php echo reloadUser(); ?>">
  <div class="container">
    <button type="submit" formaction="user/ultimosMovs.php" formmethod="post">Ultimos Movimientos</button>    
    <button type="submit" formaction="user/ingreso.php" formmethod="post">Ingreso</button>     
    <button type="submit" formaction="user/gastos.php" formmethod="post">Gasto</button>
    <button type="submit" formaction="user/eliminarMov.php" formmethod="post">Eliminar movimiento</button>
    <button type="submit" formaction="index.php">Salir</button>
  </div>
</form>
<?php
require_once '../includes/pie.php';
?>