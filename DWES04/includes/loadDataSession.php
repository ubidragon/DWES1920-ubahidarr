<?php

session_start();

function cargaUsuario() {
    if (isset($_SESSION['usuario'])) {
        $smarty->assign('nombre', $_SESSION['usuario']->getNombre());
        $smarty->assign('fecha', $_SESSION['fecha']);
    } else {
        header("Location: index.php");
    }
}

?>