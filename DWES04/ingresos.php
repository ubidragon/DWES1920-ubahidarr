<?php
require ('includes/load_Smarty.php');
require ('includes/Usuario.php');
require ('includes/Movimiento.php');
require ('includes/funciones.inc.php');
session_start();

$smarty->assign('error', '');
$smarty->assign('nombre', $_SESSION['user']->getNombre());
$smarty->assign('login', $_SESSION['user']->getLogin());
$smarty->assign('presupuesto', deficitPresupuesto());
$smarty->assign('fechaSesion', $_SESSION['fecha']);
$smarty->assign('ingresos', totalMonetario("ingresos"));
$smarty->assign('gastos', totalMonetario("gastos"));
if (isset ($_COOKIE['color'])) {
    $smarty->assign('fondo',  $_COOKIE['color']);
}
if (isset($_POST['ingreso'])) {
    nuevoMovimiento('ingresos');
}


$smarty->display('ingresos.tpl');
?>