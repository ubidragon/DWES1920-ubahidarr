<?php

require_once('DB.php');

class Movimiento {

    protected $codigoMov;
    protected $cantidad;
    protected $concepto;
    protected $fecha;

    function __construct($codigoMov, $cantidad, $concepto, $fecha) {
        $this->codigoMov = $codigoMov;
        $this->cantidad = $cantidad;
        $this->concepto = $concepto;
        $this->fecha = $fecha;
    }

    function getCodigoMov() {
        return $this->codigoMov;
    }

    function getCantidad() {
        return $this->cantidad;
    }

    function getConcepto() {
        return $this->concepto;
    }

    function getFecha() {
        return $this->fecha;
    }

    public static function numUltimoMov($login){

        $connection = DB::conexion();

        try {
        
            $consulta = $connection->prepare("SELECT MAX(codigoMov+1) FROM movimientos WHERE loginUsu=?");
            $consulta->bindParam(1, $login);
            $consulta->execute();
            $datos= $consulta->fetch(PDO::FETCH_NUM)[0];


        } catch (PDOException $e) {
        
            return $e->getCode().": ".$e->getMessage();
        
        }
        
        return $datos;



    }

    function ultimosMovs(){
            $connection=DB::conexion();
            $login =  $_SESSION['user']->getLogin();
            $tabla ="";
            
            try {
                $consulta = $connection->prepare("SELECT * FROM movimientos WHERE loginUsu=? ORDER BY `movimientos`.`fecha` DESC LIMIT 10");
                $consulta->bindParam(1, $login);
                $consulta->execute();
                $movimiento = $consulta->fetch();
                if ($movimiento) {
                    do{
                        $movimientos[] = new Movimiento($movimiento['codigoMov'], $movimiento['cantidad'], $movimiento['concepto'], $movimiento['fecha']);
                    } while ($movimiento = $consulta->fetch());
                }
                return $movimientos;
            } catch (PDOException $e) {
                return $e->getCode().": ".$e->getMessage();
            }
        }

}
