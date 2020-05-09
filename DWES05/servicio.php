<?php
require_once('funciones.php');

$uri = "http://" . $_SERVER['SERVER_NAME'] . dirname($_SERVER['REQUEST_URI']);
$url = "$uri/funciones.php";

$server = new SoapServer(null, array('uri' => $url));

$server->setClass('funciones');
$server->handle();