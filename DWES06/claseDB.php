<?php

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

?>