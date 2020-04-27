<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="./css/custom.css">
</head>
{if isset($fondo)}
<body style="background-color : {$fondo}"> 
{else}
    <body style="background-color : grey"> 
{/if}
<form class="formNotBorder">   
		<ul class="navbar">
			<li class="navbarChild"><button type="submit" formmethod="post" formaction="conta.php">Menu de usuario</button></li>
			<li class="navbarChild"><button type="submit" formmethod="post" formaction="ultimosmovimientos.php">Ultimos movimientos</button></li>
        	<li class="navbarChild"><button type="submit" formmethod="post" formaction="ingresos.php">Ingresos</button></li>
        	<li class="navbarChild"><button type="submit" formmethod="post" formaction="gastos.php">Gastos</button></li>
        	<li class="navbarChild"><button type="submit" formmethod="post" formaction="eliminarmovimientos.php">Eliminar movimientos</button></li>
			<li class="navbarChild"><button type="submit" formmethod="post" formaction="preferencias.php">Preferencias</button></li>
			<li class="navbarChild"><button name="exit" type="submit" formmethod="post" formaction="index.php">Cerrar Sesión</button></li>
		</ul>		
</form>
