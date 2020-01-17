<?php

function conexionBBDD(){
    global $connection;
    try {
        $connection = new PDO("mysql:host=localhost;port=3306;dbname=conta2", 'daw', 'daw');
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        $error = $e->getCode().": ".$e->getMessage();
    }
    return $connection;
}



/**
 * Funcion para la persistencia del usuario entre las pantallas.
 */
function reloadUser(){
    if (isset($_POST["loginUser"]) && !empty($_POST["loginUser"])) {
        $user=$_POST["loginUser"];
        return $user;
    } 

}

/**
 * Funcion para la persistencia del admin entre las pantallas.
 */
function reloadAdmin(){
    if (isset($_POST["admin"]) && !empty($_POST["admin"])) {
        $admin= $_POST["admin"];
    }	else if(isset($_GET["admin"]) && !empty($_GET["admin"]))	{
        $admin= $_GET["admin"];
    }
    return $admin;
}

/**
 * Funcion para comprobar si el usuario que se va a logar es un admin.
 */
function checkAdmin(){
    $redirect="./acceso.php";
	if ( isset($_GET['admin']) && isset($_GET['adminPassword']) && !empty($_GET['admin']) && !empty($_GET['adminPassword']) ) {
		if ( $_GET['admin'] === 'daw' && $_GET['adminPassword'] === 'daw' ) {			
			header("Location: ./gestion.php?admin=".$_GET['admin']);
		}else{
            $_GET = array();
        }
	} 
}

function nuevoIngreso(){
    $codigo=ultimoCodMov( $_POST["loginUser"])+1;
    $loginUser=$_POST["loginUser"];
    $fecha=$_POST["fechaMov"];
    $cantidad=$_POST["cantidad"];
    $concepto= $_POST["concepto"];
    nuevoMov($codigo, $loginUser, $fecha, $cantidad, $concepto);
   // header("Location: ./ultimosMovs.php");
}

function nuevoGasto(){
    $codigo=ultimoCodMov( $_POST["loginUser"])+1;
    $loginUser=$_POST["loginUser"];
    $fecha=$_POST["fechaMov"];
    $cantidad=-$_POST["cantidad"];
    $concepto= $_POST["concepto"];
    nuevoMov($codigo, $loginUser, $fecha, $cantidad, $concepto);
}

function nuevoMov($codigo, $loginUser, $fecha, $cantidad, $concepto){
    $connection=conexionBBDD();


    try {

		$consulta = $connection->prepare('INSERT INTO movimientos (codigoMov, loginUsu, fecha, concepto, cantidad) VALUES (:cod, :loginUser, :fecha, :concepto, :cantidad)');
        $consulta->bindParam(':cod', $codigo);    
        $consulta->bindParam(':loginUser', $loginUser);
        $consulta->bindParam(':fecha', $fecha);
        $consulta->bindParam(':concepto', $concepto);
        $consulta->bindParam(':cantidad', $cantidad);
        $consulta->execute();
	} catch (PDOException $e) {

		return $e->getCode().": ".$e->getMessage();
    }
   
}


/**
 * Funcion para obtener el ultimo codigo mayor almacenado en la bd.
 */
function ultimoCodMov($loginUsu){
    $connection=conexionBBDD();
    try {
		$consulta = $connection->prepare("SELECT MAX(CAST(codigoMov as int)) FROM movimientos WHERE loginUsu=?");
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


/**
 * Sentencias para base de datos
 * INSERT INTO `usuarios` (`login`, `password`, `nombre`, `fNacimiento`, `presupuesto`) VALUES ('test01', 'test01', 'Test01', '2020-01-15', '6000');
 * INSERT INTO `movimientos` (`codigoMov`, `loginUsu`, `fecha`, `concepto`, `cantidad`) VALUES ('2', 'test01', '2020-01-08', 'test01', '9.5');
 * UPDATE `usuarios` SET `login` = 'test012' WHERE `usuarios`.`login` = 'test01';
 * DELETE FROM `movimientos` WHERE `movimientos`.`codigoMov` = '10' AND `movimientos`.`loginUsu` = 'ubaldo';
 * DELETE FROM `usuarios` WHERE `usuarios`.`login` = 'test012';
 * 
 * SELECT SUM(cantidad) FROM `movimientos` WHERE loginUsu='ubaldo' ==> Saldo Total
 * SELECT SUM(cantidad) FROM `movimientos` WHERE loginUsu='ubaldo' and cantidad<0 ==> Gastos
 * SELECT SUM(cantidad) FROM `movimientos` WHERE loginUsu='ubaldo' and cantidad>0 ==> Ingreso
 * 
 */


function salir(){
    if (isset($_POST["loginUser"]) && !empty($_POST["loginUser"])) {
     unset($_POST["loginUser"]);
    // $_POST=array();
    }
}