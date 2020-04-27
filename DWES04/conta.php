<?php
require ('includes/load_Smarty.php');
require ('includes/Usuario.php');
require ('includes/funciones.inc.php');
session_start();

if (isset( $_SESSION['user'] )) {
    $smarty->assign('nombre', $_SESSION['user']->getNombre());
    $smarty->assign('presupuesto', deficitPresupuesto());
    $smarty->assign('fechaSesion', $_SESSION['fecha']);
    $smarty->assign('ingresos', totalMonetario("ingresos"));
    $smarty->assign('gastos', totalMonetario("gastos"));
    if (isset ($_COOKIE['color'])) {
        $smarty->assign('fondo',  $_COOKIE['color']);
    }
    $smarty->display('conta.tpl');
} else {
    $smarty->display('login.tpl');
}

?>