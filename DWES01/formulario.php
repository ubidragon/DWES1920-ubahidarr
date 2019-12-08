<?php
require_once 'funciones.inc.php';

reseteo($params);

$params = paramsPreload($_GET['typeform']);


?>
<form id="formulario" name="formulario" method="get" action="index.php">
    <fieldset>
        <legend>Datos básicos</legend>
        <div>
            <label for="name">Nombre:
                <input type="text" name="name" id="name" pattern="([a-zA-ZñÑ]{3,30}\s*)+" placeholder="Nombre" value="<?php if (isset($params)) echo $params["name"]; ?>" required /></label>&nbsp;
            <?php if (isset($_GET["name"])) echo checkFreeTextField($_GET["name"]); ?>
            <label for="apellidos">Apellidos:
                <input type="text" name="surname" id="surname" pattern="([a-zA-ZñÑ]{3,30}\s*)+" placeholder="Apellidos" required value="<?php if (isset($params)) echo $params["surname"]; ?>" required /></label>&nbsp;
            <?php if (isset($_GET["surname"])) echo checkFreeTextField($_GET["name"]); ?>
            <?php
            echo loadGender($params);
            ?>
            <?php if (isset($_GET["sexo"])) echo checkSex($_GET["sexo"]); ?>
        </div>
        <br />
        <div>
            <label for="date">Fecha de nacimiento:
                <input type="date" name="date" id="date" placeholder="Fecha de nacimiento" value="<?php if (isset($params)) echo $params["date"]; ?>" required /></label>&nbsp;
            <?php if (isset($_GET["date"])) echo checkBornDate($_GET["date"]); ?>
            <label for="place">Lugar de nacimiento:
                <input type="text" name="place" id="place" pattern="^.*(?=.*[A-ZÑñáéíóúÁÉÍÓÚa-z]).*$" placeholder="Lugar de nacimiento" value="<?php if (isset($params)) echo $params["place"]; ?>" required /></label>
            <?php if (isset($_GET["place"])) echo checkBirthPlace($_GET["place"]); ?>
        </div>
        <br />
        <div>
            <label for="email">Email:
                <input type="email" name="email" id="email" placeholder="Email" value="<?php if (isset($params)) echo $params["email"]; ?>" required /></label>&nbsp;
            <?php if (isset($_GET["email"])) echo checkIsEmail($_GET["email"]); ?>
            <label for="phone">Telefono:
                <input type="phone" name="phone" id="phone" placeholder="formato +34 999999999" required value="<?php if (isset($params)) echo $params["phone"]; ?>" required /></label>&nbsp;
            <?php if (isset($_GET["phone"])) echo checkIsPhone($_GET["phone"]); ?>
            <label for="url">Website Preferido:
                <input type="url" name="url" id="url" placeholder="Website" value="<?php if (isset($params)) echo $params["url"]; ?>" required /></label>
            <?php if (isset($_GET["url"])) echo checkIsUrl($_GET["url"]); ?>
        </div>
    </fieldset>
    <fieldset>
        <legend>Módulos aprobados</legend>
        <table border="1">
            <tr>
                <th>Primer<br />Curso</th>
                <td><input <?php loadSubjects($params["LMSGI"]); ?> type="checkbox" name="LMSGI" value="LMSGI">LMSGI</td>
                <td><input <?php loadSubjects($params["FOL"]); ?> type="checkbox" name="FOL" value="FOL">FOL</td>
                <td><input <?php loadSubjects($params["PROG"]); ?> type="checkbox" name="PROG" value="PROG">PROG</td>
                <td><input <?php loadSubjects($params["BBDD"]); ?> type="checkbox" name="BBDD" value="BBDD">BB.DD.</td>
                <td><input <?php loadSubjects($params["SSII"]); ?> type="checkbox" name="SSII" value="SSII">SS.II.</td>
                <td><input <?php loadSubjects($params["ED"]); ?> type="checkbox" name="ED" value="ED">E.D.</td>
            </tr>
            <tr>
                <th>Segundo<br />Curso</th>
                <td><input <?php loadSubjects($params["DWES"]); ?> type="checkbox" name="DWES" value="DWES">DWES</td>
                <td><input <?php loadSubjects($params["DWEC"]); ?> type="checkbox" name="DWEC" value="DWEC">DWEC</td>
                <td><input <?php loadSubjects($params["DAW"]); ?> type="checkbox" name="DAW" value="DAW">DAW</td>
                <td><input <?php loadSubjects($params["EIE"]); ?> type="checkbox" name="EIE" value="EIE">EIE</td>
                <td><input <?php loadSubjects($params["DIW"]); ?> type="checkbox" name="DIW" value="DIW">DIW</td>
                <td style="background-color:grey;"></td>
            </tr>
            <tr>
                <th>Tercer<br />Curso</th>
                <td><input <?php loadSubjects($params["FCT"]); ?> type="checkbox" name="FCT" value="FCT">FCT</td>
                <td><input <?php loadSubjects($params["Proyecto"]); ?> type="checkbox" name="Proyecto" value="Proyecto">Proyecto</td>
                <td style="background-color:grey;"></td>
                <td style="background-color:grey;"></td>
                <td style="background-color:grey;"></td>
                <td style="background-color:grey;"></td>
        </table>
    </fieldset>

    <fieldset>
        <legend>Conocimientos previos</legend>
        <div>
            <label for="html">HTML:
                <input type="text" name="html" id="html" pattern="^([1-9]|10)$" placeholder="HTML" value="<?php if (isset($params)) echo $params["html"]; ?>" required /></label>&nbsp;
            <?php if (isset($_GET["html"])) echo checkIsNaturalNumber($_GET["html"]); ?>
            <label for="mySQL">MySQL:
                <input type="text" name="mySQL" id="mySQL" pattern="^([1-9]|10)$" placeholder="MySQL" value="<?php if (isset($params)) echo $params["mySQL"]; ?>" required /></label>&nbsp;
            <?php if (isset($_GET["mySQL"])) echo checkIsNaturalNumber($_GET["mySQL"]); ?>
            <label for="ingles">Inglés:
                <input type="text" name="ingles" id="ingles" pattern="^([1-9]|10)$" placeholder="Inglés" value="<?php if (isset($params)) echo $params["ingles"]; ?>" required /></label>
            <?php if (isset($_GET["ingles"])) echo checkIsNaturalNumber($_GET["ingles"]); ?>
            <br /> <br />
            <label for="php">PHP:
                <input type="text" name="php" id="php" pattern="^([1-9]|10)$" placeholder="PHP" value="<?php if (isset($params)) echo $params["php"]; ?>" required /></label>&nbsp;
            <?php if (isset($_GET["php"])) echo checkIsNaturalNumber($_GET["php"]); ?>
            <label for="javascript">Javascript:
                <input type="text" name="javascript" id="javascript" pattern="^([1-9]|10)$" placeholder="JavaScript" value="<?php if (isset($params)) echo $params["javascript"]; ?>" required /></label>
            <?php if (isset($_GET["javascript"])) echo checkIsNaturalNumber($_GET["javascript"]); ?>
    </fieldset>
    <fieldset>
        <legend>Conocimientos previos</legend>
        <div>
            <label for="salarioActual">Salario Actual:
                <input type="text" name="salarioActual" id="salarioActual" pattern="^[0-9]*\,[0-9][0-9]$" placeholder="Salario Actual" value="<?php if (isset($params)) echo $params["salarioActual"]; ?>&euro;" required /></label>&nbsp;
            <?php if (isset($_GET["salarioActual"])) echo checkIsSalary($_GET["salarioActual"]); ?>
            <label for="salarioDeseado">Salario Deseado:
                <input type="text" name="salarioDeseado" id="salarioDeseado" pattern="^[0-9]*\,[0-9][0-9]$" placeholder="Salario Deseado" value="<?php if (isset($params)) echo $params["salarioDeseado"]; ?>&euro;" required /></label>&nbsp;
            <?php if (isset($_GET["salarioDeseado"])) echo checkIsSalary($_GET["salarioDeseado"]); ?>
    </fieldset>
    <br />
    <div>

        <?php

        if (isset($_GET['typeform'])) {
            $botonera .= '<input type="hidden" name="typeform" id="typeform" value="' . $_GET['typeform'] . '" />';
        }
        $botonera .= '<input type="submit" name="send" id="send" value="Enviar" />';
        echo $botonera;
        ?>
    </div>
</form>

<form id="cleaner" name="cleaner" method="get" action="index.php">
    <input type="submit" name="clear" id="clear" value="Borrar Contenidos" />
</form>

<?php
/*No es la forma mas elegante de hacerlo pero si creo que es la mejor forma en este caso para poder enviar el contenido al back para poder hacer los chequeos pertinentes.
*/
if (strpos($_GET['typeform'], "Broken")) { ?>
    <form id="formularioErrores" name="formularioErrores" method="get" action="index.php">
        <p>El formulario contiene errores, ¿esta seguro de enviarlo para que el servidor compruebe dichos fallos? <br />Se enviará al servidor sin la comprobacion en el front por parte de Html5</p>
        <?php
            loadBrokenParamWithoutVerification($params);
            ?>
        <input type="submit" name="send" id="send" value="Enviar con errores" />
    </form>
<?php } ?>



<div class="story">

    <?php
    if (isset($_GET["send"])) {
        echo generateStory();
    }

    ?>

</div>