<?php
/**
 * Clase de funciones 
 * Tarea de SOAP.
 * Autor: Ubaldo Hidalgo Arriaga (ubidragon)
 */
class funciones {

    /**
     * Crea una conexion con la base de datos de morosos.
     * @return \PDO
     */
    private function accesoBD(){
        global $connection;
        try {
            $connection = new PDO("mysql:host=localhost;port=3306;dbname=morosos", 'dwes', 'abc123.');
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            $error = $e->getCode().": ".$e->getMessage();
        }
        return $connection;
    
    }

    /**
     * Consulta los anunciantes que no estan bloqueados en la base de datos
     * @return array listado de anunciantes no bloqueados
     */
    public function getDesbloqueados() {
        $connection=self::accesoBD();        
        try {
            $consulta = $connection->prepare("SELECT login, email FROM anunciantes WHERE bloqueado = 0");
            $consulta->execute();
            $unlock = $consulta->fetch();
            if ($unlock) {
                do{
                    $unlocks[] = $unlock;
                } while ($unlock = $consulta->fetch());
                return $unlocks;
            }else{
                return "";
            }
            return $unlocks;
        } catch (PDOException $e) {
            return $e->getCode().": ".$e->getMessage();
        }
    }

    /**
     * Consulta el escaparate desde la fecha introducida hacia atras
     * @param string $fecha fecha de inicio de busqueda
     * @return array listado de los escaparates
     */
    public function getEscaparate($fecha){
        $connection=self::accesoBD();        
        try {
            $consulta = $connection->prepare("SELECT anuncios.*, anunciantes.email FROM anuncios INNER JOIN anunciantes ON anuncios.autor = anunciantes.login WHERE anuncios.fecha <=? ORDER BY anuncios.fecha DESC");
            $consulta->bindParam(1, $fecha);
            $consulta->execute();
            $escaparate = $consulta->fetch();
            echo $escaparate;
            if ($escaparate) {
                do{
                    $escaparates[] = $escaparate;
                } while ($escaparate = $consulta->fetch());            
                return $escaparates;
            }else{
                return "";
            }
            
        } catch (PDOException $e) {
            return $e->getCode().": ".$e->getMessage();
        }
    }

    /**
     * Consulta un anunciante dado un login
     * @param string $login Login del anunciantes que se busca
     * @return string El email del anunciante
     */
    public function getAnunciantes($login){
        $connection=self::accesoBD();        
        try {
            $consulta = $connection->prepare("SELECT email FROM anunciantes WHERE login = ?");
            $consulta->bindParam(1, $login);
            $consulta->execute();
            $usuario = $consulta->fetch(PDO::FETCH_ASSOC);
            if ($usuario) {
                return $usuario['email'];
            }else{
                return "";
            }
        } catch (PDOException $e) {
            return $e->getCode().": ".$e->getMessage();
        }
    }
}