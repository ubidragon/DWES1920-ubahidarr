<?php

class DB {

    static function conexion(){
        global $connection;
        try {
            $connection = new PDO("mysql:host=localhost;port=3306;dbname=conta4", 'daw', 'daw');
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            $error = $e->getCode().": ".$e->getMessage();
        }
        return $connection;
    }
        
}

?>
