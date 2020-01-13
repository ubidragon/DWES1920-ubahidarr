<?php
require_once("../includes/header.inc.php");
$user=$_POST["user"];
echo reloadUser();
?>
<link rel="stylesheet" href="../css/custom.css">
<h2>Ultimos Movimientos</h2>
<p><i>Nombre de Usuario - Fecha y hora de la conexion</i></p>

<?php
require_once '../includes/pie.php';
?>