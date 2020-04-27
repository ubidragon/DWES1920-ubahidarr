<?php

require_once('DB.php');

class Usuario {
   
    protected $login;
    protected $nombre;
    protected $presupuesto;
    
    function __construct($login, $nombre, $presupuesto) {
        $this->login = $login;
        $this->nombre = $nombre;
        $this->presupuesto = $presupuesto;
    }
    
    function getLogin() {
        return $this->login;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getPresupuesto() {
        return $this->presupuesto;
    }

    public static function existeUsuario($login){
        $connection = DB::conexion();

        try {
        
            $consulta = $connection->prepare("SELECT login FROM usuarios WHERE login=?");
            $consulta->bindParam(1, $login);
            $consulta->execute();
            $user= $consulta->fetch();

            return $user;

        } catch (PDOException $e) {
        
            return $e->getCode().": ".$e->getMessage();
        
        }
        
    }

    public static function checkPassword($login, $password) {

        $connection = DB::conexion();

        try {
            $existe = self::existeUsuario($login);
            if ( !empty($existe)) {
                $consulta = $connection->prepare("SELECT password FROM usuarios WHERE login=?");
                $consulta->bindParam(1, $login);
                $consulta->execute();
                $password_bd= $consulta->fetch();
    
                return password_verify($password, $password_bd['password']);
            } else {
                return false;
            }
            


        } catch (PDOException $e) {
        
            return $e->getCode().": ".$e->getMessage();
        
        }
        
    }
    
    public static function datosUsuario($login){

        $connection = DB::conexion();

        try {
        
            $consulta = $connection->prepare("SELECT nombre, presupuesto FROM usuarios WHERE login=?");
            $consulta->bindParam(1, $login);
            $consulta->execute();
            $datos= $consulta->fetch();

            return new Usuario($login, $datos['nombre'], $datos['presupuesto']);

        } catch (PDOException $e) {
        
            return $e->getCode().": ".$e->getMessage();
        
        }       

    }

}

?>
