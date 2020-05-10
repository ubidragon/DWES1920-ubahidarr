<?php
require ('claseProducto.php');


class DB {

    static function conexion(){
        global $connection;
        try {
            $connection = new PDO("mysql:host=localhost;port=3306;dbname=amazonia", 'root', '');
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            $error = $e->getCode().": ".$e->getMessage();
        }
        return $connection;
    }
        
}

$response = array();


function datosTabla(){
    $connection=DB::conexion();
    global $response;
    try {
        $consulta = $connection->prepare("SELECT * FROM producto ");
        $consulta->execute();
        $producto = $consulta->fetch();
        if ($producto) {
            do{
                $productos[] = array('codigo' => $producto['cod'],'nombre' =>$producto['nombre'],'descripcion' =>$producto['descripcion'],'PVP' =>$producto['PVP'],'familia' =>$producto['familia'],'stock' =>$producto['stock']);                
            } while ($producto = $consulta->fetch());
        }        

       $response["tabla"] = $productos;
    } catch (PDOException $e) {
        return $e->getCode().": ".$e->getMessage();
    }
}


if (isset($_POST['buscar']) && !empty($_POST['buscar'][1])){
    $connection=DB::conexion();
    $valor = "%".$_POST['buscar'][1]."%";
    try {
        $consulta = $connection->prepare("SELECT * FROM producto where nombre LIKE ?");
        $consulta->bindParam(1, $valor);
        $consulta->execute();
        $producto = $consulta->fetch();
        if ($producto) {
           
            do{
                $productos[] = array('nombre' =>$producto['nombre']);                
            } while ($producto = $consulta->fetch());
        }        
        $buscar = array("buscar" => $productos);
        echo json_encode($productos);
    } catch (PDOException $e) {
        return $e->getCode().": ".$e->getMessage();
    }
}

datosTabla();

echo json_encode($response["tabla"]);


?>