<?php
require_once("../includes/header.inc.php");
checkAdmin();
nuevoUser();
?>
<link rel="stylesheet" href="../css/custom.css">
<h2>Nuevo Usuario</h2>

<form action="nuevoUsuario.php" method="post">
<input type="hidden" name="admin" value="<?php echo reloadAdmin(); ?>">
    <div class="container">
        <label for="name"><b>Nombre</b></label>
        <input type="text" placeholder="Introduzca nombre de usuario" name="name" required maxlength="30" value="<?php if (isset($_POST['name'])) echo $_POST['name'] ;?>" pattern="([a-zA-ZñÑ]{3,30}\s*)+">
        <label for="newLogin"><b>Login de usuario</b></label>
        <input type="text" placeholder="Introduzca login de usuario" name="newLogin" required maxlength="20" value="<?php if (isset($_POST['newLogin'])) echo $_POST['newLogin'] ;?>" pattern="([a-zA-ZñÑ]{3,20}\s*)+">
    </div>
    <div class="container">        
        <label for="pass"><b>Contraseña de usuario</b></label>
        <input type="password" placeholder="Introduzca Contraseña" name="pass" required maxlength="128" value="<?php if (isset($_POST['pass'])) echo $_POST['pass'] ;?>" >
        <label for="checkPass"><b>Repita la contraseña</b></label>
        <input type="password" placeholder="Repita la contraseña" name="checkPass" required maxlength="128">
    </div>
    <div class="container">
        <label for="fechaNacimiento"><b>Fecha de nacimiento del usuario</b></label>
        <input type="date" placeholder="Fecha de nacimiento" name="fechaNacimiento" value="<?php if (isset($_POST['fechaNacimiento'])) echo $_POST['fechaNacimiento'] ;?>" required>    
    </div>
    <div class="container">
        <label for="presupuesto"><b>Presupuesto anual del usuario</b></label>
        <input type="number" min="0" step="0.01" placeholder="Presupuesto anual" name="presupuesto" value="<?php if (isset($_POST['presupuesto'])) echo $_POST['presupuesto'] ;?>" required pattern="^[0-9]*\,[0-9][0-9]$">
    </div>
    <div class="container">
        <button type="submit" name="crear">Guardar nuevo usuario</button>
    </div>
</form>

<?php
require_once '../includes/pie.php';
?>