<?php
require ('load_Smarty.php');
/**
 * Metodo para realizar las comprobaciones previas a insertar en bd
 */
function nuevoMovimiento($param){
    $fecha;$cantidad;$concepto;

    if ( isset($_POST['ingreso']) || isset($_POST['gasto']) ) {
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
//Todo: la uri modificarla por un smarty display            
            $codigo=ultimoCodMov( $_SESSION['user']->getLogin())+1;
            $loginUser=$_SESSION['user']->getLogin();
            nuevoMov($codigo, $loginUser, $fecha, $cantidad, $concepto);
            header('Location: ultimosmovimientos.php');
        }else{
            $smarty->assign('error', checkParametrosMovimientos($fecha,$cantidad,$concepto));
        }

    }

}


/**
 * Funcion para insertar nuevos movimientos en la base de datos
 */

function nuevoMov($codigo, $loginUser, $fecha, $cantidad, $concepto){
    $connection=DB::conexion();


    try {

		$consulta = $connection->prepare('INSERT INTO movimientos (codigoMov, loginUsu, fecha, concepto, cantidad) VALUES (:cod, :loginUser, :fecha, :concepto, :cantidad)');
        $consulta->bindParam(':cod', $codigo);    
        $consulta->bindParam(':loginUser', $loginUser);
        $consulta->bindParam(':fecha', $fecha);
        $consulta->bindParam(':concepto', $concepto);
        $consulta->bindParam(':cantidad', $cantidad);
        $consulta->execute();
        echo "<div class='navbarOk'><p>Movimiento creado correctamente.</p></div>";
	} catch (PDOException $e) {

		return $e->getCode().": ".$e->getMessage();
    }
   
}


/**
 * Funcion para obtener el ultimo codigo mayor almacenado en la bd.
 */
function ultimoCodMov($loginUsu){
    $connection=DB::conexion();
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

function eliminarMovimientos(){
    if ( isset($_POST['eliminar'])) {
          $ok = destruyeMovimientos($_POST['codigoMov']); 
          return $ok;
    }   

}


function destruyeMovimientos($codigos){
    $connection=DB::conexion();
    $login =  $_SESSION['user']->getLogin();
    
    try {
        foreach ($codigos as $idMov){
            $consulta = $connection->prepare("DELETE FROM movimientos WHERE codigoMov = :codigo AND loginUsu = :login");
            $consulta->bindParam(':login', $login);
            $consulta->bindParam(':codigo', $idMov);
            $consulta->execute();
        }
        return true;
    } catch (PDOException $e) {
        return $e->getCode().": ".$e->getMessage();
    }
}

function cuentaMovimientos(){
    $connection=DB::conexion();
       
    try {
            $consulta = $connection->prepare("SELECT COUNT(*) FROM movimientos");
            $consulta->execute();
            return $consulta->fetch(PDO::FETCH_NUM)[0];
    } catch (PDOException $e) {
        return $e->getCode().": ".$e->getMessage();
    }

}


function destruyeMovimientosAll(){
    $connection=DB::conexion();
       
    try {
            $consulta = $connection->prepare("DELETE FROM movimientos");
            $consulta->execute();

    } catch (PDOException $e) {
        return $e->getCode().": ".$e->getMessage();
    }
}

function totalMonetario($param){
    $connection=DB::conexion();
    $login = $_SESSION['user']->getLogin();
    
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
    $connection=DB::conexion();
    $login =  $_SESSION['user']->getLogin();
    
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
    if (is_numeric($gastos)) {
        $gastos*=-1; 
    }
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
 }


 function tiempoSesion(){
    $datetime1 = new DateTime($_SESSION['fecha']);
    $datetime2 = new DateTime(strftime("%d-%m-%Y %X"));
    $interval = $datetime1->diff($datetime2);
    return $interval->format('%h Horas %i Minutos %s Segundos');
 }