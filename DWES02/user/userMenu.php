<?php
require_once("../includes/header.inc.php");
?>
<link rel="stylesheet" href="../css/custom.css">
<h2>Pantalla de Inicio</h2>

<form>
  <div class="container">
    <button type="submit" formaction="ultimosMovs.php" formmethod="post" name="user" value="<?php echo reloadUser(); ?>">Ultimos Movimientos</button>
    
    <button type="submit" formaction="ingreso.php">Ingreso</button>     
    <button type="submit" formaction="gasto.php">Gasto</button>
    <button type="submit" formaction="eliminarMov.php">Eliminar movimiento</button>
    <button type="submit" formaction="registro.php">Salir</button>
  </div>
</form>
<?php
require_once '../includes/pie.php';
?>