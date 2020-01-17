<?php
require_once("../includes/header.inc.php");
checkAdmin();
?>
<link rel="stylesheet" href="../css/custom.css">
<h2>Modifica Usuario</h2>

<form action="acceso.php" method="post">
<input type="hidden" name="admin" value="<?php echo reloadAdmin(); ?>">
    <div class="container">        
        <label for="searchLogin"><b>Buscar login de usuario</b></label>
        <input type="text" placeholder="Introduzca login de usuario" name="searchLogin" required>
    </div>
    <div class="container">
        <button type="submit">Buscar usuario</button>
    </div>
</form>
<form action="acceso.php" method="post">
    <div class="container">
        <label for="name"><b>Nombre</b></label>
        <input type="text" placeholder="Introduzca nombre de usuario" name="name" required maxlength="30">
        <label for="loginUser"><b>Login de usuario</b></label>
        <input type="text" name="loginUser" value="usuario elegido" readonly disabled maxlength="20">
    </div>
    <div class="container">        
        <label for="pass"><b>Contraseña de usuario</b></label>
        <input type="password" placeholder="Introduzca Contraseña" name="pass" required maxlength="128">
        <label for="checkPass"><b>Repita la contraseña</b></label>
        <input type="password" placeholder="Repita la contraseña" name="checkPass" required maxlength="128">
    </div>
    <div class="container">
        <label for="fechaNacimiento"><b>Fecha de nacimiento del usuario</b></label>
        <input type="date" placeholder="Fecha de nacimiento" name="fechaNacimiento" required>    
    </div>
    <div class="container">
        <label for="presupuesto"><b>Presupuesto anual del usuario</b></label>
        <input type="number" min="0" step="0.01" placeholder="Presupuesto anual" name="presupuesto" required>
    </div>
    <div class="container">
        <button type="submit">Guardar cambios del usuario</button>
    </div>
</form>

<?php
require_once '../includes/pie.php';
?>