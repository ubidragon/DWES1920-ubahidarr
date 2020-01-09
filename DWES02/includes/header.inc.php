<?php
date_default_timezone_set('Europe/Madrid');
setlocale (LC_TIME, "es_ES");
require_once("funciones.inc.php");


try {
	$connection = new PDO('mysql:host=localhost;dbname=conta2', 'daw', 'daw');
	$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
	$error = $e->getCode().": ".$e->getMessage();
}

?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="./css/custom.css">
</head>
<body>