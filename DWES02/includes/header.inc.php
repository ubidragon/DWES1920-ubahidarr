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
<?php //Si no estas en index -> mostrar menu. ?>
    <ul class="navbar">
	<?php //Si es admin mostrar esto?>
		<li class="navbarChild"><a href="index.php">Menú de administracion</a></li>
        <li class="navbarChild"><a href="index.php">Nuevo usuario</a></li>
        <li class="navbarChild"><a href="index.php?typeform=preload">Modificar usuario</a></li>
        <li class="navbarChild"><a href="index.php?typeform=preloadIrreal">Borrar usuario</a></li>
        <li class="navbarChild"><a href="index.php?typeform=preloadBroken">Cerrar sesión</a></li>
	<?php //Si es admin mostrar esto?>
		<li class="navbarChild"><a href="index.php">Menu de usuario</a></li>
		<li class="navbarChild"><a href="index.php">Ultimos movimientos</a></li>
        <li class="navbarChild"><a href="index.php?typeform=preload">Ingresos</a></li>
        <li class="navbarChild"><a href="index.php?typeform=preloadIrreal">Gastos</a></li>
        <li class="navbarChild"><a href="index.php?typeform=preloadBroken">Eliminar movimientos</a></li>
        <li class="navbarChild"><a href="index.php?typeform=preloadBroken2">Cerrar sesión</a></li>
    </ul>