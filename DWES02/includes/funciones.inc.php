<?php
/**
 * Funcion para generalizar la conexion con bbdd
 */
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
    } else if (isset($_GET["loginUser"]) && !empty($_GET["loginUser"])){
        $user=$_GET["loginUser"];
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

/**
 * Metodo para realizar las comprobaciones previas a insertar en bd
 */
function nuevoMovimiento($param){
    $fecha;$cantidad;$concepto;

    if ( isset($_POST['ingreso']) || isset($_POST['gastar']) ) {
        if (isset($_POST["fechaMov"]) && !empty($_POST["fechaMov"])) {
            $fecha=$_POST["fechaMov"];
        }else{
            $fecha=null;
        }

        if (isset($_POST["cantidad"]) && !empty($_POST["cantidad"])) {
            $cantidad=$_POST["cantidad"];
            if ($param == 'gastos') {
                $cantidad*=-1;
            }
            
        }else {
            $cantidad=null;
        }

        if (isset($_POST["concepto"]) && !empty($_POST["concepto"])) {
            $concepto=$_POST["concepto"];
        }else{
            $concepto=null;
        }

       if ((isset($_POST["fechaMov"]) && !empty($_POST["fechaMov"]))
        && (isset($_POST["cantidad"]) && !empty($_POST["cantidad"]))
        && (isset($_POST["concepto"]) && !empty($_POST["concepto"]))   
        && checkParametrosMovimientos($fecha,$cantidad,$concepto)) {
            
            $codigo=ultimoCodMov( $_POST["loginUser"])+1;
            $loginUser=$_POST["loginUser"];
            nuevoMov($codigo, $loginUser, $fecha, $cantidad, $concepto);
            $uri = ParentUri().'ultimosMovs.php';
//            RedirectWithMethodPost($uri, $_POST);
            header('Location: '.$uri.'?loginUser='.$_POST["loginUser"]);
        }else{
            echo "<div class='navbarError'>".checkParametrosMovimientos($fecha,$cantidad,$concepto)."</div>";
        }

    }

}


/**
 * Funcion para insertar nuevos movimientos en la base de datos
 */

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


function ultimosMovs(){

    $connection=conexionBBDD();
    $login = reloadUser();
    $tabla ="";
    
    try {
        $consulta = $connection->prepare("SELECT * FROM movimientos WHERE loginUsu=? ORDER BY `movimientos`.`fecha` DESC LIMIT 10");
        $consulta->bindParam(1, $login);
        $consulta->execute();
        if ($consulta->fetch()) {
            $tabla.='<table><tr><th>Fecha del movimiento</th><th>Concepto</th><th>Cantidad</th></tr>';
       
        while ($movimiento = $consulta->fetch()){
        $tabla.= '<tr>';
        $tabla.= '<td>'.$movimiento[2].'</td>';
        $tabla.= '<td>'.$movimiento[3].'</td>';
        $tabla.= '<td>'.$movimiento[4].'</td>';
        $tabla.= '</tr>';
        }
        $tabla.='</table>';
    }else{
        $tabla.= '    <div class="container">
        No hay movimientos que mostrar
    </div>';
    }
    echo $tabla;
    } catch (PDOException $e) {
        return $e->getCode().": ".$e->getMessage();
    }
}

function eliminarMovimientos(){
    if ( isset($_POST['eliminar'])) {
        foreach ($_POST['codigoMov'] as $codigo){
            destruyeMovimiento($codigo); 
        }
    }   

}
function elementosEliminar(){

    $connection=conexionBBDD();
    $login = reloadUser();
    $tabla ="";
    
    try {
        $consulta = $connection->prepare("SELECT * FROM movimientos WHERE loginUsu=? ORDER BY `movimientos`.`fecha` DESC LIMIT 10");
        $consulta->bindParam(1, $login);
        $consulta->execute();
        if ($consulta->fetch()) {
            $tabla.='<table><tr><th></th><th>Fecha del movimiento</th><th>Concepto</th><th>Cantidad</th></tr>';
       $i = 0;
        while ($movimiento = $consulta->fetch()){
        $tabla.= '<tr>';
        $tabla.= '<td><input type="checkbox" name="codigoMov[]" value="'.$movimiento[0].'"/></td>';       
        $tabla.= '<td>'.$movimiento[2].'</td>';
        $tabla.= '<td>'.$movimiento[3].'</td>';
        $tabla.= '<td>'.$movimiento[4].'</td>';
        $tabla.= '</tr>';
        }
        $tabla.='</table>';
    }else{
        $tabla.= '<div class="container">
        No hay movimientos que mostrar
    </div>';
    }
    echo $tabla;
    } catch (PDOException $e) {
        return $e->getCode().": ".$e->getMessage();
    }
}

function destruyeMovimiento($idMov){
    $connection=conexionBBDD();
    $login = reloadUser();
    
    try {
        $consulta = $connection->prepare("DELETE FROM movimientos WHERE codigoMov = :codigo AND loginUsu = :login");
        $consulta->bindParam(':login', $login);
        $consulta->bindParam(':codigo', $idMov);
        $consulta->execute();

    } catch (PDOException $e) {
        return $e->getCode().": ".$e->getMessage();
    }
}

function totalMonetario($param){
    $connection=conexionBBDD();
    $login = reloadUser();
    
    try {
        if ($param == 'ingresos') {
            $consulta = $connection->prepare("SELECT CAST(SUM(cantidad) as DECIMAL(12,2)) FROM movimientos WHERE loginUsu=? and cantidad>0");
        } else if ($param == 'gastos') {
            $consulta = $connection->prepare("SELECT CAST(SUM(cantidad) as DECIMAL(12,2)) FROM movimientos WHERE loginUsu=? and cantidad<0");
        }
        $consulta->bindParam(1, $login);
        $consulta->execute();
        $total =$consulta->fetch(PDO::FETCH_NUM)[0];
        if (empty($total)) {
            $total = "Sin movimientos registrados";
        }
        return $total;
    } catch (PDOException $e) {
        return $e->getCode().": ".$e->getMessage();
    }
}

function presupuestoPorUsuario(){
    $connection=conexionBBDD();
    $login = reloadUser();
    
    try {
        $consulta = $connection->prepare("SELECT presupuesto FROM usuarios WHERE login=?");
        $consulta->bindParam(1, $login);
        $consulta->execute();
        $total =$consulta->fetch(PDO::FETCH_NUM)[0];
        if (empty($total)) {
            $total = "Sin presupuesto establecido";
        }
        return $total;
    } catch (PDOException $e) {
        return $e->getCode().": ".$e->getMessage();
    }
}

function deficitPresupuesto(){
    $gastos= totalMonetario('gastos');
    $gastos*=-1;
    $presupuestoBD = presupuestoPorUsuario();
    $presupuesto ="";
    if ($presupuestoBD>$gastos || !is_numeric($gastos)) {
        $presupuesto = '<p style="color:green"><i>Presupuesto anual: '.$presupuestoBD.'</i></p>';
    } else {
        $presupuesto = '<p style="color:red"><i>Presupuesto anual: '.$presupuestoBD.'</i></p>';
    }
    return $presupuesto;
}

/**
 * Checks de la aplicacion
 */

 /**
  * Funcion para la impresion de errores por pantalla
  */
 function checkParametrosMovimientos($fecha, $cantidad, $concepto){
    
    $error="";
    
    if (checkFecha($fecha)!=false) {
         $error.="<p>".checkFecha($fecha)."</p>";
     } 
     if(checkCantidad($cantidad)!=false) {
        $error.="<p>".checkCantidad($cantidad)."</p>";
     }
     if(checkConcepto($concepto)!=false) {
        $error.="<p>".checkConcepto($concepto)."</p>";
    }
    
    if (!empty($error) ) {
        return $error;
    } else {
        return true;
    }
    
 }

 /**
  * Chequeo del campo concepto
  */
 function checkConcepto($concepto){

    if ( empty($concepto) ) {
        return 'El concepto es obligatorio.';
    }

    if ( strlen($concepto) > 20 ) {
		return "El concepto no puede tener mas de 20 caracteres.";
    }
    
    return false;
 }

  /**
  * Chequeo del campo cantidad
  */
 function checkCantidad($cantidad){
    if ( empty($cantidad) ) {
        return 'La cantidad no ha sido indicada';
    }
    if ($cantidad <= 0){
        return 'La cantidad debe ser mayor que 0.En caso de ser un gasto se convertira en negativo en el backend.';
    }

    return false;

 }

  /**
  * Chequeo del campo fecha
  */
 function checkFecha($fecha){
    if ( empty($fecha) ) {
        return 'Fecha no indicada.';
    }
    $fechaTrozos = explode("-", $fecha);
    if ( count($fechaTrozos) != 3 || !checkdate($fechaTrozos[1], $fechaTrozos[2], $fechaTrozos[0])) {
        return 'Error en el formato de la fecha';
    }
    return false;

/**
 * Funcion para poder hacer el redirect a UltimosMovimientos pudiendo pasar parametros y asi persistir el login del usuario.
 */
 function RedirectWithMethodPost($url, array $data, array $headers = null) {
    $params = array(
        'http' => array(
            'method' => 'POST',
            'content' => http_build_query($data)
        )
    );
    if (!is_null($headers)) {
        $params['http']['header'] = '';
        foreach ($headers as $k => $v) {
            $params['http']['header'] .= "$k: $v\n";
        }
    }
    $ctx = stream_context_create($params);
    $fp = @fopen($url, 'rb', false, $ctx);
    if ($fp) {
        echo @stream_get_contents($fp);
        die();
    } else {
        // Error
        throw new Exception("Error loading '$url', $php_errormsg");
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