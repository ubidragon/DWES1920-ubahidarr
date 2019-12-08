<?php
require_once 'cabecera.php';
include 'funciones.inc.php';
?>
<form id="formulario" name="formulario" method="get" action="autoevaluacion.php">
    <table border="1">
        <caption>Autoevaluación</caption>
        <?php
        echo autoevaluacion();
        echo $_GET['alumno'];
        ?>

    </table>
    <input type="submit" name="send" id="send" value="Calcular nota" />
</form>
<?php
require_once 'pie.php';
?>