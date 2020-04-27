<?php

require_once('includes/Usuario.php');
require_once('includes/funciones.inc.php');
require ('includes/load_Smarty.php');

session_start(); 

if (isset($_POST['exit']) && isset($_SESSION['user'])) {
    $tiempo = 'Tiempo de Sesion: '.tiempoSesion();
    $_POST = array();
    unset($_POST);
    session_destroy();  
    $smarty->assign('tiempo', $tiempo);
}


if (isset($_POST['reset'])) {

    $cuenta = cuentaMovimientos();

    if ($cuenta == 0) {
        $smarty->assign('movs', "Ningun movimiento que eliminar");
    } else {
        $smarty->assign('movs', "Se han eliminado ".$cuenta." movimientos");
    }
    

    destruyeMovimientosAll();

    $_POST = array();
    unset($_POST);
}
if (isset($_POST['access'])) {

    if (empty($_POST['loginUser']) || empty($_POST['password'])) {
        $smarty->assign('msg', 'Debes introducir un nombre de usuario y una contraseña');
    } else {

        if (Usuario::checkPassword($_POST['loginUser'], $_POST['password'])) {
            session_start();
            $_SESSION['user'] = Usuario::datosUsuario($_POST['loginUser']);
            setlocale(LC_ALL, "es_ES");
            $_SESSION['fecha'] = strftime("%d-%m-%Y %X");
            header("Location: conta.php");
        } else {
            $smarty->assign('msg', 'Usuario o contraseña no válidos.');
        }
    }
}

$smarty->display('login.tpl');
?>