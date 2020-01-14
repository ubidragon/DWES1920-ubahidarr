<?php
date_default_timezone_set('Europe/Madrid');
setlocale (LC_TIME, "es_ES");
require_once("funciones.inc.php");


try {
	$connection = new PDO('mysql:host=localhost;dbname=conta2', 'daw', 'daw');
	$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
	$error = $e->getCode().": ".$e->getMessage();
}

?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>    
	<?php if (isset($_POST["userName"]) && !empty($_POST["userName"])) { ?>
		<ul class="navbar">
			<li class="navbarChild"><a href="index.php">Menú de administracion</a></li>
        	<li class="navbarChild"><a href="index.php">Nuevo usuario</a></li>
        	<li class="navbarChild"><a href="index.php?typeform=preload">Modificar usuario</a></li>
        	<li class="navbarChild"><a href="index.php?typeform=preloadIrreal">Borrar usuario</a></li>
			<li class="navbarChild"><a href="index.php?typeform=preloadBroken">Cerrar sesión</a></li>
		</ul>
		<p><i><?php echo $_POST["userName"]?></i></p>
	<?php }
		else if (isset($_POST["admin"]) && !empty($_POST["admin"])) { 
	?>
		<ul class="navbar">
			<li class="navbarChild"><a href="index.php">Menu de usuario</a></li>
			<li class="navbarChild"><a href="index.php">Ultimos movimientos</a></li>
        	<li class="navbarChild"><a href="index.php?typeform=preload">Ingresos</a></li>
        	<li class="navbarChild"><a href="index.php?typeform=preloadIrreal">Gastos</a></li>
        	<li class="navbarChild"><a href="index.php?typeform=preloadBroken">Eliminar movimientos</a></li>
        	<li class="navbarChild"><a href="index.php?typeform=preloadBroken2">Cerrar sesión</a></li>
		</ul>
		<p><i><?php echo $_POST["admin"]?></i></p>
<?php
}
?>