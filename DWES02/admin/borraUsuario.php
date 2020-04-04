<?php
require_once("../includes/header.inc.php");
$usuario ="";
if(is_array(dataUpdateUser()) ){
    $usuario = dataUpdateUser();
}else{
    echo dataUpdateUser();
}
eliminarUsuarios()
?>
<h2>Eliminar usuario</h2>
<form action="borraUsuario.php" method="post">
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
<form action="borraUsuario.php" method="post">
<input type="hidden" name="admin" value="<?php echo reloadAdmin(); ?>">
<?php
usuariosEliminar();
?>
  <div class="container">        
    <button type="submit" name="eliminar">Eliminar usuario</button>
  </div>
</form>
<?php
}
require_once '../includes/pie.php';
?>