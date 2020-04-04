<?php
require_once("./includes/funciones.inc.php");
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body> 
<form id="formulario" name="formulario" method="get" action="autoevaluacion.php">
    <table border="1">
        <caption>Autoevaluación</caption>
        <?php
        echo autoevaluacion();

        ?>

    </table>
    <input type="submit" name="send" id="send" value="Calcular nota" />
</form>
<img src="./resources/login.png" width="100%"/>
<img src="./resources/ultimosMovs.png" width="100%"/>
<img src="./resources/newUser.png" width="100%"/>
<img src="./resources/deleteMov.png" width="100%"/>
<?php
require_once './includes/pie.php';
?>