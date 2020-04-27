<?php
require ('includes/load_Smarty.php');
require ('includes/Usuario.php');
require ('includes/Movimiento.php');
require ('includes/funciones.inc.php');
session_start();

$smarty->assign('nombre', $_SESSION['user']->getNombre());
$smarty->assign('presupuesto', deficitPresupuesto());
$smarty->assign('fechaSesion', $_SESSION['fecha']);
$smarty->assign('ingresos', totalMonetario("ingresos"));
$smarty->assign('gastos', totalMonetario("gastos"));
if ( !empty(Movimiento::numUltimoMov($_SESSION['user']->getLogin()))) {
    $smarty->assign('movimientos', Movimiento::ultimosMovs());
}
if (isset ($_COOKIE['color'])) {
    $smarty->assign('fondo',  $_COOKIE['color']);
}
$smarty->display('ultimosmovimientos.tpl');
?>