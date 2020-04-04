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
<p>Como mi entorno es un Vs Code con un lamp desplegado sobre docker, muestro la ventana del Vs Code, la del lamp desplegado y como los contenedores docker estan corriendo en este momento, tanto el del webserver(Apache) como el de mysql.</p>
<img src="./resources/VsCode-LampStack.png" width="100%"/>
<p>Visual de los componentes de Lamp junto con su versiones</p>
<img src="./resources/lampStack.png" width="100%"/>
<p>Aportaciones en el foro sobre el uso de docker en los presenciales</p>
<img src="./resources/foro01.png" width="100%"/>
<p>Aportaciones en el foro sobre el uso de docker en los presenciales (volumen 2)</p>
<img src="./resources/foro02.png" width="100%"/>
<?php
require_once 'pie.php';
?>