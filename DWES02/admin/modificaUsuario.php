<?php
require_once("../includes/header.inc.php");
checkAdmin();
$usuario ="";
if(is_array(dataUpdateUser()) ){
    $usuario = dataUpdateUser();
}else{
    echo dataUpdateUser();
}
updateUser();
?>
<link rel="stylesheet" href="../css/custom.css">
<h2>Modifica Usuario</h2>

<form action="modificaUsuario.php" method="post">
<input type="hidden" name="admin" value="<?php echo reloadAdmin(); ?>">
    <div class="container">        
        <label for="searchLogin"><b>Buscar login de usuario</b></label>
        <input type="text" placeholder="Introduzca login de usuario" name="searchLogin" >
    </div>
    <div class="container">
        <button type="submit" name="search">Buscar usuario</button>
    </div>
</form>
<?php if(isset($_POST['searchLogin']) && !empty($_POST['searchLogin']) && is_array(dataUpdateUser())){?>
<form action="modificaUsuario.php" method="post">
<input type="hidden" name="admin" value="<?php echo reloadAdmin(); ?>">
<input type="hidden" name="searchLogin" value="<?php echo $_POST['searchLogin']; ?>">
    <div class="container">
        <label for="name"><b>Nombre</b></label>
        <input type="text" placeholder="Introduzca nombre de usuario" name="name" value="<?php echo $usuario['nombre'] ?>" maxlength="30" pattern="([a-zA-ZñÑ]{3,30}\s*)+">
        <label for="loginUser"><b>Login de usuario</b></label>
        <input type="text" name="loginUser" value="<?php echo $usuario['login'] ?>"readonly disabled maxlength="20">
    </div>
    <div class="container">        
        <label for="pass"><b>Contraseña de usuario</b></label>
        <input type="password" placeholder="Introduzca Contraseña" name="pass"  maxlength="128">
        <label for="checkPass"><b>Repita la contraseña</b></label>
        <input type="password" placeholder="Repita la contraseña" name="checkPass"  maxlength="128">
    </div>
    <div class="container">
        <label for="fechaNacimiento"><b>Fecha de nacimiento del usuario</b></label>
        <input type="date" placeholder="Fecha de nacimiento" name="fechaNacimiento" value="<?php echo $usuario['fNacimiento'] ?>" >    
    </div>
    <div class="container">
        <label for="presupuesto"><b>Presupuesto anual del usuario</b></label>
        <input type="number" min="0" step="0.01" placeholder="Presupuesto anual" name="presupuesto" value="<?php echo $usuario['presupuesto'] ?>"  pattern="^[0-9]*\,[0-9][0-9]$">
    </div>
    <div class="container">
        <button type="submit" name="guardar" >Guardar cambios del usuario</button>
    </div>
</form>
<?php
}
require_once '../includes/pie.php';
?>