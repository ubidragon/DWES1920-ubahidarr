<?php
require_once("../includes/header.inc.php");
nuevoIngreso();
?>

<h2>Ingreso</h2>
<?php nuevoMovimiento('ingresos'); ?>
<form action="ingreso.php" method="post">
<input type="hidden" name="loginUser" value="<?php echo reloadUser(); ?>">
    <div class="container">
        <label for="loginUser"><b>Login de usuario</b></label>
        <input type="text" name="loginUser" value="<?php echo reloadUser(); ?>" maxlength="20" required readonly disabled> 
        <label for="fechaMov"><b>Fecha del movimiento</b></label>
        <input type="date" placeholder="Fecha de nacimiento" name="fechaMov" required>
        <label for="cantidad"><b>Cantidad</b></label>
        <input type="number" min="0" step="0.01" placeholder="Cantidad" name="cantidad" required> 
    </div>
    <div class="container">
        <label for="concepto"><b>Concepto</b></label><br/>
        <textarea type="textarea" name="concepto" placeholder="Concepto" cols="25" rows="1" maxlength="20" required></textarea>
    </div>
    <div class="container">
        <button type="submit">Ingresar dinero</button>
    </div>
</form>
<?php
require_once '../includes/pie.php';
?>