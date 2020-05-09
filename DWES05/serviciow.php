<?php
require_once('funciones.php');


$url = "http://" . $_SERVER['SERVER_NAME'] . dirname($_SERVER['REQUEST_URI']) . "/funciones.wsdl";

$server = new SoapServer($url);

$server->setClass('Funciones');
$server->handle();