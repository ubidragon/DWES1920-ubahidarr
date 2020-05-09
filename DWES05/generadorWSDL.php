<?php
require_once ('funciones.php');
require_once ('WSDLDocument.php');

header ("Content-Type:text/xml");

$uri = "http://" . $_SERVER['SERVER_NAME'] . dirname($_SERVER['REQUEST_URI']);
$service = $uri ."/serviciow.php";

//Creamos el archivo wsdl
$wsdl = new WSDLDocument("funciones", $service, $uri);

// echo $wsdl->saveXml();

//Debe de tener permisos de escritura con esto conseguimso generar el wsdl en disco
$File = "funciones.wsdl"; 
$Handle = fopen($File, 'w');
$Data = $wsdl->saveXml(); 
fwrite($Handle, $Data); 
fclose($Handle); 

//redirigue al clientew para que se pueda usar el wsdl
header('Location: clientew.php');

?>