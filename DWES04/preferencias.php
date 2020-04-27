<?php
require ('includes/load_Smarty.php');
require ('includes/Usuario.php');
require ('includes/Movimiento.php');
require ('includes/funciones.inc.php');

session_start();
$cookieName = "color";
if (isset($_POST['borrar'])) {
    
    setcookie($cookieName,  "", time() - 3600);
    $_POST = array();
    unset($_POST);
    header('Location: preferencias.php');
}elseif (isset($_POST['seleccionar'])) {
   
    if (isset($_COOKIE[$cookieName])) {
        setcookie($_COOKIE[$cookieName],  "", time() - 3600);
    }
    if (isset($_POST['color'])){      
        setcookie($cookieName, $_POST['color']);
    } 
}




if (isset( $_SESSION['user'] )) {
    $smarty->assign('nombre', $_SESSION['user']->getNombre());
    $smarty->assign('presupuesto', deficitPresupuesto());
    $smarty->assign('fechaSesion', $_SESSION['fecha']);
    $smarty->assign('ingresos', totalMonetario("ingresos"));
    $smarty->assign('gastos', totalMonetario("gastos")); 

    if (isset($_POST['color']) && !isset($_POST['borrar'])){         
        $smarty->assign('fondo',  $_POST['color']); 
    }elseif (isset($_COOKIE['color']) && !isset($_POST['borrar'])) {
        $smarty->assign('fondo',  $_COOKIE['color']);
    }

    $smarty->display('preferencias.tpl');
} else {
    $smarty->display('login.tpl');
}

?>