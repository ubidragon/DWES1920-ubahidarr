<?php
require ('claseProducto.php');

class DB {

    static function conexion(){
        global $connection;
        try {
            $connection = new PDO("mysql:host=localhost;port=3306;dbname=amazonia", 'root', '');
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $connection->exec("set names utf8");
        } catch (PDOException $e) {
            $error = $e->getCode().": ".$e->getMessage();
        }
        return $connection;
    }

    public static function datosTabla(){
        $connection=self::conexion();
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
       

    public static function insertarProducto($articulo){
        $connection=self::conexion();
       
        $cod = $articulo[0];
        $nombre = $articulo[1];
        $descripcion = $articulo[2];
        $PVP = $articulo[3];
        $familia = $articulo[4];
        $stock = $articulo[5];



        try {

            $consulta = $connection->prepare('INSERT INTO producto (cod, nombre, descripcion, PVP, familia, stock) VALUES (:cod, :nombre, :descripcion, :PVP, :familia, :stock)' );
            $consulta->bindParam(':cod', $cod);
            $consulta->bindParam(':nombre', $nombre);
            $consulta->bindParam(':descripcion', $descripcion);
            $consulta->bindParam(':PVP', $PVP);
            $consulta->bindParam(':familia', $familia);
            $consulta->bindParam(':stock', $stock);
            $consulta->execute();
        } catch (PDOException $e) {
            return $e->getCode().": ".$e->getMessage();
        }
    }

    public static function editarProducto($articulo){
        $connection=self::conexion();
       
        $codigo = $articulo[0];
        $stock = $articulo[5];

        try {

            $consulta = $connection->prepare('UPDATE producto SET stock = :stock WHERE cod = :cod' );
            $consulta->bindParam(':cod', $codigo);
            $consulta->bindParam(':stock', $stock);
            $consulta->execute();
        } catch (PDOException $e) {
            return $e->getCode().": ".$e->getMessage();
        }
    }

    public static function eliminarProducto($articulo){
        $connection=self::conexion();
        $codigo = $articulo[0];
        try {

            $consulta = $connection->prepare("DELETE FROM producto WHERE cod= :codigo");
            $consulta->bindParam(':codigo', $codigo);
            $consulta->execute();

        } catch (PDOException $e) {
            return $e->getCode().": ".$e->getMessage();
        }
    }
    // public function buscaPatron($patron){
    //     $connection=self::conexion();    
    //     try {
    //         $consulta = $connection->prepare("SELECT * FROM producto where nombre LIKE ?");
    //         $consulta->bindParam(1, $patron);
    //         $consulta->execute();
    //         $producto = $consulta->fetch();
    //         if ($producto) {
            
    //             do{
    //                 $productos[] = array('nombre' =>$producto['nombre']);                
    //             } while ($producto = $consulta->fetch());
    //         }        
    //         $buscar = array("buscar" => $productos);
    //         $response["buscar"] = json_encode($productos)
    //     } catch (PDOException $e) {
    //         return $e->getCode().": ".$e->getMessage();
    //     }
    // }
}
    if (isset($_POST['accionProducto']) && $_POST['accionProducto']=="insertar"){

        $articulo = $_POST['articulo'];
        DB::insertarProducto($articulo);

    }elseif (isset($_POST['accionProducto']) && $_POST['accionProducto']=="editar") {
        
        $articulo = $_POST['articulo'];
        DB::editarProducto($articulo);

    }elseif (isset($_POST['accionProducto']) && $_POST['accionProducto']=="borrar") {
        

        $articulo = $_POST['articulo'];
        DB::eliminarProducto($articulo);

    }

    DB::datosTabla();
    
    echo json_encode($response["tabla"]);






?>