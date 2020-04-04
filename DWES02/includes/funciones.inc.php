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
        echo "<div class='navbarOk'><p>Movimiento creado correctamente.</p></div>";
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
        $movimiento = $consulta->fetch();
        if ($movimiento) {
            $tabla.='<table><tr><th>Fecha del movimiento</th><th>Concepto</th><th>Cantidad</th></tr>';
            do{
            $tabla.= '<tr>';
            $tabla.= '<td>'.$movimiento[2].'</td>';
            $tabla.= '<td>'.$movimiento[3].'</td>';
            $tabla.= '<td>'.$movimiento[4].'</td>';
            $tabla.= '</tr>';
            } while ($movimiento = $consulta->fetch());
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
        $movimiento = $consulta->fetch();
        if ($movimiento) {
            $tabla.='<table><tr><th></th><th>Fecha del movimiento</th><th>Concepto</th><th>Cantidad</th></tr>';
            do{
            $tabla.= '<tr>';
            $tabla.= '<td><input type="checkbox" name="codigoMov[]" value="'.$movimiento[0].'"/></td>';       
            $tabla.= '<td>'.$movimiento[2].'</td>';
            $tabla.= '<td>'.$movimiento[3].'</td>';
            $tabla.= '<td>'.$movimiento[4].'</td>';
            $tabla.= '</tr>';
            }while($movimiento = $consulta->fetch());
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
        echo "<div class='navbarOk'><p>Movimiento eliminado correctamente.</p></div>";
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
 }

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

function login(){
    $connection=conexionBBDD();
    if (isset($_POST["loginUser"]) && !empty($_POST["loginUser"]) && isset($_POST["password"]) && !empty($_POST["password"])) {
        $loginUsu = $_POST["loginUser"];
        $usuario = "";
        $password= $_POST["password"];

        try {
            $consulta = $connection->prepare("SELECT login, password FROM usuarios WHERE login=?");
            $consulta->bindParam(1, $loginUsu);
            $consulta->execute();
            $usuario= $consulta->fetch();
            if(is_array($usuario) ){

                if ((!empty($loginUsu) && $usuario['login']==$loginUsu) && (!empty($password) && $usuario['password']==$password)) {
                    $uri = ParentUri().'user/userMenu.php';
                    RedirectWithMethodPost($uri, $_POST);                    
                }else{
                    echo "<div class='navbarError'><p>Error. Usuario y/o Contraseña incorrectos.</p></div>";
                }
            }else{
                echo "<div class='navbarError'><p>Error. Usuario y/o Contraseña incorrectos.</p></div>";

            }

        } catch (PDOException $e) {
            return $e->getCode().": ".$e->getMessage();
        }

    }
}


function ParentUri(){
    $parent = explode("/", trim(dirname($_SERVER['PHP_SELF'])));
    $uri = 'http://'.$_SERVER['SERVER_NAME'];
    foreach($parent as $path){
        $uri.=$path."/";
    }
    return $uri;
}

function salir(){
    if (isset($_POST["loginUser"]) && !empty($_POST["loginUser"])) {
        unset($_POST["loginUser"]);
        $_POST=array();
        
    }
}


/**
 * Administracion
 */


/**
 * Funcion para insertar nuevos usuario en la base de datos
 */

function nuevoUser(){
    $connection=conexionBBDD();

    if (isset($_POST["crear"])){

        if (checkCampos()) {
            # code...
            $login = $_POST['newLogin'];
            $password = $_POST['pass'];
            $nombre = $_POST['name'];
            $fNacimiento = $_POST['fechaNacimiento'];
            $presupuesto = $_POST['presupuesto'];

            try {

                $consulta = $connection->prepare('INSERT INTO usuarios (login, password, nombre, fNacimiento, presupuesto) VALUES (:login, :password, :nombre , :fNacimiento, :presupuesto)' );
                $consulta->bindParam(':login', $login);
                $consulta->bindParam(':password', $password);
                $consulta->bindParam(':nombre', $nombre);
                $consulta->bindParam(':fNacimiento', $fNacimiento);
                $consulta->bindParam(':presupuesto', $presupuesto);
                $consulta->execute();
                echo "<div class='navbarOk'><p>Usuario creado correctamente.</p></div>";
            } catch (PDOException $e) {

                return $e->getCode().": ".$e->getMessage();
            }
        }else{
            echo "<div class='navbarError'>".checkCampos()."</div>";
        }
    }
}

function checkCampos(){

        $error="";
        
        if (checkLogin()!=false) {
             $error.="<p>".checkLogin()."</p>";
         } 
         if(checkPassword()!=false) {
            $error.="<p>".checkPassword()."</p>";
         }
         if(checkNombre()!=false) {
            $error.="<p>".checkNombre()."</p>";
        }
        if(checkNacimiento()!=false) {
            $error.="<p>".checkNacimiento()."</p>";
        }

        if(checkPresupuesto()!=false) {
            $error.="<p>".checkPresupuesto()."</p>";
        }
        
        
        if (!empty($error) ) {
            return $error;
        } else {
            return true;
        }
        
}

function checkNacimiento(){
   if ( empty($_POST['fechaNacimiento']) ) {
       return 'Fecha no indicada.';
   }
   $fechaTrozos = explode("-", $_POST['fechaNacimiento']);
   if ( count($fechaTrozos) != 3 || !checkdate($fechaTrozos[1], $fechaTrozos[2], $fechaTrozos[0])) {
       return 'Error en el formato de la fecha';
   }
   return false;
}

function checkPresupuesto(){
    if ( empty($_POST['presupuesto']) ) {
        return 'El presupuesto no ha sido indicado';
    }
    if ($_POST['presupuesto'] <= 0){
        return 'El presupuesto debe ser mayor que 0';
    }

    return false;

 }

 function checkNombre(){

    if ( empty($_POST['name'] ) ) {
        return 'El nombre es obligatorio.';
    }

    if ( strlen($_POST['name'] ) > 30 ) {
		return "El nombre no puede tener mas de 30 caracteres.";
    }
    
    return false;
 }

function checkLogin(){
    if (empty($_POST['newLogin']) ) {
        return 'El login es obligatorio.';
    }
        $connection=conexionBBDD();
    
        $loginUsu = $_POST["newLogin"];

        try {
            $consulta = $connection->prepare("SELECT login FROM usuarios WHERE login=?");
            $consulta->bindParam(1, $loginUsu);
            $consulta->execute();
            $usuario= $consulta->fetch();
            if(is_array($usuario) ){
                return "El usuario ya existe en la base de datos";
            }

        }catch (PDOException $e) {

            return $e->getCode().": ".$e->getMessage();
        }
    
    return false;
}
function checkPassword(){

    if (empty($_POST['pass'])) {
        return 'La contraseña es obligatoria';
    } 

    if ($_POST['pass']!= $_POST['checkPass']){
        return 'Las contraseñas deben de seer iguales';
    }

    return false;
}



function dataUpdateUser(){
    $connection=conexionBBDD();

    if ((isset($_POST["search"]) && isset($_POST['searchLogin']) && !empty($_POST["searchLogin"]))
    || (isset($_POST["guardar"])) ){

            $login = $_POST['searchLogin'];

            try {

                $consulta = $connection->prepare('SELECT * FROM usuarios WHERE login=?' );
                $consulta->bindParam(1, $login);
                $consulta->execute();
                $usuario = $consulta->fetch();
                if(is_array($usuario) ){
                    return $usuario;
                }else{
                    return "<div class='navbarError'><p>Error. Usuario inexistente.</p></div>";
                }
            } catch (PDOException $e) {
                return $e->getCode().": ".$e->getMessage();
            }
    }
}

function updateUser(){
    $connection=conexionBBDD();
    $data = array();
    if (isset($_POST['guardar']) ){
        $usuario = dataUpdateUser();
        if($usuario['nombre']!=$_POST['name']){
            $data['nombre'] = $_POST['name'];
        }else{
            $data['nombre'] = $usuario['nombre'];
        }

        if($usuario['fNacimiento']!=$_POST['fechaNacimiento']){
            $data['fecha'] = $_POST['fechaNacimiento'];
        }else{
            $data['fecha'] = $usuario['fNacimiento'];
        }
        if($usuario['presupuesto']!=$_POST['presupuesto']){
            $data['presupuesto'] = $_POST['presupuesto'];
        }else{
            $data['presupuesto'] = $usuario['presupuesto'];
        }
        if((isset($_POST['pass']) && !empty($_POST['pass']))
            && (isset($_POST['checkPass']) && !empty($_POST['checkPass']))
            && checkPassword()){
            $data['pass'] = $_POST['pass'];
        }else{
            $data['pass'] = $usuario['password'];
        }
            try {
                $consulta = $connection->prepare('UPDATE usuarios SET nombre = :name, password=:pass, fNacimiento=:fecha, presupuesto=:presupuesto WHERE login = :login' );
                $consulta->bindParam(':login', $_POST['loginUser']);
                $consulta->bindParam(':name', $data['nombre']);
                $consulta->bindParam(':pass', $data['pass']);
                $consulta->bindParam(':fecha', $data['fecha']);
                $consulta->bindParam(':presupuesto', $data['presupuesto']);
                $consulta->execute();
                echo "<div class='navbarOk'><p>Usuario actualizado correctamente.</p></div>";
            } catch (PDOException $e) {
                return $e->getCode().": ".$e->getMessage();
            }

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

function eliminarUsuarios(){
    if ( isset($_POST['eliminar'])) {
            destruyeUsuario($_POST['usuario'] ); 
    }   
}
function usuariosEliminar(){

    $connection=conexionBBDD();
    $login = $_POST['searchLogin'];
    $tabla ="";
    
    try {
        $consulta = $connection->prepare("SELECT * FROM usuarios WHERE login=?");
        $consulta->bindParam(1, $login);
        $consulta->execute();
        $usuario = $consulta->fetch(PDO::FETCH_ASSOC);
        if ($usuario) {
            $tabla.='<table><tr><th></th><th>Login de usuario</th><th>Nombre de usuario</th><th>Fecha Nacimiento</th><th>Presupuesto</th></tr>';
            $tabla.= '<tr>';
            $tabla.= '<td><input type="checkbox" name="usuario" value="'.$usuario['login'].'"/></td>';       
            $tabla.= '<td>'.$usuario['login'].'</td>';
            $tabla.= '<td>'.$usuario['nombre'].'</td>';
            $tabla.= '<td>'.$usuario['fNacimiento'].'</td>';
            $tabla.= '<td>'.$usuario['presupuesto'].'</td>';
            $tabla.= '</tr>';
  
            $tabla.='</table>';
        }else{
            $tabla.= '<div class="container">
            No hay usuarios que mostrar
        </div>';
        }
        echo $tabla;
    } catch (PDOException $e) {
        return $e->getCode().": ".$e->getMessage();
    }
}

function destruyeUsuario($user){
    $connection=conexionBBDD();
    $login = $_POST['usuario'];
    
    try {
        $consulta = $connection->prepare("DELETE FROM movimientos WHERE loginUsu= :login");
        $consulta->bindParam(':login', $login);
        $consulta->execute();

    } catch (PDOException $e) {
        return $e->getCode().": ".$e->getMessage();
    }

    try {
        $consulta = $connection->prepare("DELETE FROM usuarios WHERE login= :login");
        $consulta->bindParam(':login', $login);
        $consulta->execute();
        echo "<div class='navbarOk'><p>Usuario eliminado correctamente.</p></div>";
    } catch (PDOException $e) {
        return $e->getCode().": ".$e->getMessage();
    }
}



/**
 * Autoevaluaciones
 */
function autoevaluacion()
{

    $archivo = fopen("./resources/Hidalgo_Arriaga_Ubaldo_DWES02_Auto-evaluacion.csv", "r");

    $table = "<thead><tr><th>Item</th><th>Nota Maxima</th><th>Nota Alumno</th><th>Nota Profesor</th><th>Observaciones</th></tr></thead>";

    /*     if (isset($_GET['send'])) {
        $result = autoevUser($archivo, $table);
    } else { */
    $result = lineToLine($archivo, $table);
    /*   }/*  */


    fclose($archivo);
    return  $result;
}

function lineToLine($archivo, $table)
{
    $notaAlumno = 0;
    $notaProfesor = 0;
    $itemNum = 1;


    while (($linea = fgets($archivo)) !== false) {

        $datos = explode(";", $linea);

        $item = $datos[0];
        $notaMax = $datos[1];

        $alumno = str_replace(",", ".", $datos[2]);
        $profesor = str_replace(",", ".", $datos[3]);
        $observaciones = $datos[4];

        //cargamos valores en la tabla

    
        $elementAlum = "itemAlum" . $itemNum;
        $elementProf = "itemProf" . $itemNum;
        $elementObs = "obs" . $itemNum;
        $elementDescrip = "descrip" . $itemNum;
        if (isset($_GET[$elementDescrip])) {
            if ($_GET[$elementDescrip] === "menos") {
                $table .= "<tr><td>" . verMas($item, 20) . "<br/><button name='".$elementDescrip."' value='mas'>VER MÁS</button></td>";
            }else if($_GET[$elementDescrip] ==="mas"){
                $table .= "<tr><td>" . verMas($item, strlen($item)) . "<br/><button name='".$elementDescrip."' value='menos'>VER MENOS</button></td>";
            }
        } else {
            $table .= "<tr><td>" . verMas($item, 20) . "<br/><button name='".$elementDescrip."' value='mas'>VER MÁS</button></td>";

        }
        
        $table .= "<td style='text-align:center'>" . $notaMax . "</td>";
        if (isset($_GET[$elementAlum])) {

            if ($itemNum == "14") {
                $table .= "<td><input type='number' name='itemAlum" . $itemNum . "' value='" . $_GET[$elementAlum] . "' min='-10' max='0' step='0.2' ></input></td>";
            } else {
                $table .= "<td><input type='number' name='itemAlum" . $itemNum . "' value='" . $_GET[$elementAlum] . "' min='0'  max='" . str_replace(",", ".", $notaMax) . "' step='0.05' ></input></td>";
            }
            $notaAlumno += floatval($_GET[$elementAlum]);
        } else {
            if ($itemNum == "14") {
                $table .= "<td><input type='number' name='itemAlum" . $itemNum . "' value='" . $alumno . "' min='-10'  max='0' step='0.2' ></input></td>";
            } else {
                $table .= "<td><input type='number' name='itemAlum" . $itemNum . "' value='" . $alumno . "' min='0'  max='" . str_replace(",", ".", $notaMax) . "' step='0.05' ></input></td>";

            }

            $notaAlumno += floatval($alumno);
        }
        if (isset($_GET[$elementProf])) {

            if ($itemNum === "15") {
                $table .= "<td><input type='number' name='itemProf" . $itemNum . "'value='" . $_GET[$elementProf] . "' min='-10'  max='0' step='0.2' ></input></td>";
            } else {
                $table .= "<td><input type='number' name='itemProf" . $itemNum . "'value='" . $_GET[$elementProf] . "' min='0'  max='" . str_replace(",", ".", $notaMax) . "' step='0.05' ></input></td>";
            }

            $notaProfesor += floatval($_GET[$elementProf]);
        } else {

            if ($itemNum === "14") {
                $table .= "<td><input type='number' name='itemProf" . $itemNum . "'value='" . $profesor . "' min='-10'  max='0' step='0.2' ></input></td>";
            } else {
                $table .= "<td><input type='number' name='itemProf" . $itemNum . "'value='" . $profesor . "' min='0'  max='" . str_replace(",", ".", $notaMax) . "' step='0.05' ></input></td>";
            }
            $notaProfesor += floatval($profesor);
        }
        if (isset($_GET[$elementObs])) {
            $table .= "<td><textarea name='obs" . $itemNum . "' rows='4' cols='50'>" . $_GET[$elementObs] . "</textarea></td></tr>";
        } else {
            $table .= "<td><textarea name='obs" . $itemNum . "' rows='4' cols='50'>" . $observaciones . "</textarea></td></tr>";
        }

        $itemNum++;
    }


    return notasTotales($table, $notaAlumno, $notaProfesor);
}

function notasTotales($table, $notaAlumno, $notaProfesor)
{
    $item = "Total";
    $notaMax = 10;
    $alumno = str_replace(",", ".", $notaAlumno);
    $profesor = str_replace(",", ".", $notaProfesor);


    $table .= "<tr><td>" . $item . "</td>";
    $table .= "<td style='text-align:center'>" . $notaMax . "</td>";
    $table .= "<td><input type='number' name='alumnoTotal' value='" . $alumno . "' min='0'  max='" . str_replace(",", ".", $notaMax) . "' step='0.05' ></input></td>";
    $table .= "<td><input type='number' name='profesorTotal' value='" . $profesor . "' min='0'  max='" . str_replace(",", ".", $notaMax) . "' step='0.05' ></input></td>";
    $table .= "<td style='background-color:grey;'></td></tr>";
    return $table;
}


function verMas($texto, $cantidad)
{
    $verMas="";
    $separadorTexto =str_split($texto);
    if (count($separadorTexto) > $cantidad) {
        for ($i = 0; $i < $cantidad; $i++) {
            $verMas .= htmlspecialchars($separadorTexto[$i]) . "";
        }
        $verMas .= " ...";
    } else {
        $verMas = $texto;
    }
    return $verMas;
}
