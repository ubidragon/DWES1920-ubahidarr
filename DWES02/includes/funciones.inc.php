<?php
/**
 * Funcion para la persistencia del usuario entre las pantallas.
 */
function reloadUser(){
    if (isset($_POST["userName"]) && !empty($_POST["userName"])) {
        return $user=$_POST["userName"];
    }
}
/**
 * Funcion para comprobar si el usuario que se va a logar es un admin.
 * TODO: Diseñar un banner con warning de acceso no permitido.
 */
function checkAdmin(){
    $redirect='./acceso.php';
	if ( !empty($_POST['admin']) && !empty($_POST['adminPassword']) ) {
		if ( $_POST['admin'] === 'daw' && $_POST['adminPassword'] === 'daw' ) {			
			header("Location: ./gestion.php?".$_POST['admin']);
		}		
	} else {
        header("Location: $redirect");
    }

}

/**
 * Funcion para obtener el ultimo codigo mayor almacenado en la bd.
 */
function ultimoCodMov($loginUsu){
    try {
		$consulta = $conexion->prepare("SELECT MAX(CAST(codigoMov as int)) FROM movimientos WHERE loginUsu=?");
        $consulta->bindParam(1, $loginUsu);
        $consulta->execute();
        $codigo = $consulta->fetch(PDO::FETCH_NUM)[0];
        if ($codigo=="") {
            $codigo="0";
        }
        return $codigo;
	} catch (PDOException $e) {
		return $e->getCode().": ".$e->getMessage();
    }
    
}

function fechaLogin(){

if (isset($_POST["fechaLogin"]) && !empty($_POST["fechaLogin"])) {
	$fechaLogin=$_POST["fechaLogin"];
}else{
	$fechaLogin=date("d-m-Y H:i:s");
}
return $fechaLogin;
}

function salir(){
    unset($_POST["user"]);
}