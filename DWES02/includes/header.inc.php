<?php
date_default_timezone_set('Europe/Madrid');
setlocale (LC_TIME, "es_ES");
require_once("funciones.inc.php");

$parent = explode("/", trim(dirname($_SERVER['PHP_SELF'])));
					$uri = 'http://'.$_SERVER['SERVER_NAME'];
					array_pop($parent);
                    foreach($parent as $path){
                        $uri.=$path."/";
                    }

?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<body> 
<link rel="stylesheet" href="<?php echo $uri.'css/custom.css'?>">
<form class="formNotBorder">   
	<?php if ((isset($_POST["loginUser"]) && !empty($_POST["loginUser"])) || (isset($_GET["loginUser"]) && !empty($_GET["loginUser"]))){ ?>
		<input type="hidden" name="loginUser" value="<?php echo reloadUser();?>">
		<ul class="navbar">
			<li class="navbarChild"><button type="submit" formmethod="post" formaction="<?php echo $uri.'user/userMenu.php'; ?>">Menu de usuario</button></li>
			<li class="navbarChild"><button type="submit" formmethod="post" formaction="<?php echo $uri.'user/ultimosMovs.php'; ?>">Ultimos movimientos</button></li>
        	<li class="navbarChild"><button type="submit" formmethod="post" formaction="<?php echo $uri.'user/ingreso.php'; ?>">Ingresos</button></li>
        	<li class="navbarChild"><button type="submit" formmethod="post" formaction="<?php echo $uri.'user/gastos.php'; ?>">Gastos</button></li>
        	<li class="navbarChild"><button type="submit" formmethod="post" formaction="<?php echo $uri.'user/eliminarMov.php'; ?>">Eliminar movimientos</button></li>
			<li class="navbarChild"><a href="<?php echo $uri; ?>">Cerrar sesión</a></li>		
		</ul>
		<p><i>Usuario: <?php echo reloadUser();?></i></p>
		<p><i>Total de ingresos: <?php echo totalMonetario('ingresos');?></i></p>
		<p><i>Total de gastos: <?php echo totalMonetario('gastos');?></i></p>
		<?php echo deficitPresupuesto();?>
	<?php }
		else if ((isset($_POST["admin"]) && !empty($_POST["admin"])) || (isset($_GET["admin"]) && !empty($_GET["admin"])) ){ 				
	?>
	<input type="hidden" name="admin" value="<?php echo reloadAdmin(); ?>">
		<ul class="navbar">
			<li class="navbarChild"><button type="submit" formmethod="post" formaction="<?php echo $uri.'admin/gestion.php'?>">Menú de administracion</button></li>
        	<li class="navbarChild"><button type="submit" formmethod="post" formaction="<?php echo $uri.'admin/nuevoUsuario.php'?>">Nuevo usuario</button></li>
        	<li class="navbarChild"><button type="submit" formmethod="post" formaction="<?php echo $uri.'admin/modificaUsuario.php'?>">Modificar usuario</button></li>
        	<li class="navbarChild"><button type="submit" formmethod="post" formaction="<?php echo $uri.'admin/borraUsuario.php'?>">Borrar usuario</button></li>
			<li class="navbarChild"><a href="<?php echo $uri; ?>">Cerrar sesión</a></li>		
		</ul>
		<p><i>Administrador: <?php echo reloadAdmin()?></i></p>
<?php
}
?>
</form>