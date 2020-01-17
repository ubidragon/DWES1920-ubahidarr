<?php
date_default_timezone_set('Europe/Madrid');
setlocale (LC_TIME, "es_ES");
require_once("funciones.inc.php");




?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body> 
<form class="formNotBorder">   
	<?php if (isset($_POST["loginUser"]) && !empty($_POST["loginUser"])) { ?>
		<input type="hidden" name="loginUser" value="<?php echo $_POST["loginUser"] ?>">
		<ul class="navbar">
			<li class="navbarChild"><button type="submit" formmethod="post" formaction="userMenu.php">Menu de usuario</button></li>
			<li class="navbarChild"><button type="submit" formmethod="post" formaction="ultimosMovs.php">Ultimos movimientos</button></li>
        	<li class="navbarChild"><button type="submit" formmethod="post" formaction="ingreso.php">Ingresos</button></li>
        	<li class="navbarChild"><button type="submit" formmethod="post" formaction="gastos.php">Gastos</button></li>
        	<li class="navbarChild"><button type="submit" formmethod="post" formaction="eliminarMov.php">Eliminar movimientos</button></li>
			<li class="navbarChild"><a href="../">Cerrar sesión</a></li>		
		</ul>
		<p><i>Usuario: <?php echo $_POST["loginUser"]?></i></p>
	<?php }
		else if ((isset($_POST["admin"]) && !empty($_POST["admin"])) || (isset($_GET["admin"]) && !empty($_GET["admin"])) ){ 				
	?>
	<input type="hidden" name="admin" value="<?php echo reloadAdmin(); ?>">
		<ul class="navbar">
			<li class="navbarChild"><button type="submit" formmethod="post" formaction="gestion.php">Menú de administracion</button></li>
        	<li class="navbarChild"><button type="submit" formmethod="post" formaction="nuevoUsuario.php">Nuevo usuario</button></li>
        	<li class="navbarChild"><button type="submit" formmethod="post" formaction="modificaUsuario.php">Modificar usuario</button></li>
        	<li class="navbarChild"><button type="submit" formmethod="post" formaction="borraUsuario.php">Borrar usuario</button></li>
			<li class="navbarChild"><button type="submit" formmethod="post" formaction="../">Cerrar sesión</button></li>
		</ul>
		<p><i>Administrador: <?php echo reloadAdmin()?></i></p>
<?php
}
?>
</form>