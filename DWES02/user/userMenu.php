<?php
require("../includes/header.inc.php");
?>
<link rel="stylesheet" href="../css/custom.css">
<h2>Pantalla de Inicio</h2>

<form>
<input type="hidden" name="loginUser" value="<?php echo reloadUser(); ?>">
  <div class="container">
    <button type="submit" formaction="ultimosMovs.php" formmethod="post">Ultimos Movimientos</button>    
    <button type="submit" formaction="ingreso.php" formmethod="post">Ingreso</button>     
    <button type="submit" formaction="gasto.php" formmethod="post">Gasto</button>
    <button type="submit" formaction="eliminarMov.php" formmethod="post">Eliminar movimiento</button>
    <button type="submit" formaction="../">Salir</button>
  </div>
</form>
<?php
require_once '../includes/pie.php';
?>