<?php
require_once("../includes/header.inc.php");
?>
<link rel="stylesheet" href="../css/custom.css">
<h2>Gasto</h2>
<?php nuevoMovimiento('gastos'); ?>
<form action="gastos.php" method="post">
<input type="hidden" name="loginUser" value="<?php echo reloadUser(); ?>" pattern="([a-zA-ZñÑ]{3,30}\s*)+">
    <div class="container">
        <label for="loginUser"><b>Login de usuario</b></label>
        <input type="text" name="loginUser" value="<?php echo reloadUser(); ?>" maxlength="20" pattern="([a-zA-ZñÑ]{3,30}\s*)+" readonly disabled> 
        <label for="fechaMov"><b>Fecha del movimiento</b></label>
        <input type="date" placeholder="Fecha de nacimiento" name="fechaMov" value="<?php if (isset($_POST['fechaMov'])) echo $_POST['fechaMov'] ;?>" required>
    </div>
    <div class="container">
        <label for="cantidad"><b>Cantidad*</b></label>
        <input type="number" min="0" step="0.01" placeholder="Cantidad" name="cantidad" value="<?php if (isset($_POST['cantidad'])) echo $_POST['cantidad'] ;?>" pattern="^[0-9]*\,[0-9][0-9]$" required> 
        <p><i>*Los valores se convertiran al negativo en el backend</i></p>
    </div>
    <div class="container">
        <label for="concepto"><b>Concepto</b></label><br/>
        <textarea type="textarea" name="concepto" placeholder="Concepto" cols="25" rows="1" maxlength="20" value="<?php if (isset($_POST['concepto'])) echo $_POST['concepto'] ;?>" required></textarea>
    </div>
    <div class="container">
        <button type="submit" name="gastar">Realizar Gasto</button>
    </div>
</form>
<?php
require_once '../includes/pie.php';
?>