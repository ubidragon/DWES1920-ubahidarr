<?php

date_default_timezone_set('UTC');


function paramsPreload($typeform)
{
    if (!isset($_GET['typeform'])) {
        $params = array("name" => $_GET['name']);
    } else if ($_GET['typeform'] == 'preload') {
        $params = array("name" => "Ubaldo", "surname" => "Hidalgo", "sexo" => "Hombre", "date" => "1994-06-20", "place" => "Sevilla", "email" => "ubidragon@protonmail.com", "phone" => "+34 666 33 66 55", "url" => "https://darebee.com/", "html" => "7", "mySQL" => "7", "ingles" => 5, "php" => "2", "javascript" => "8", "LMSGI" => "checked", "FOL" => "checked", "PROG" => "checked", "BBDD" => "checked", "SSII" => "checked", "ED" => "checked", "DWEC" => "checked", "DAW" => "checked", "EIE" => "checked", "DIW" => "checked", "salarioActual" => "15000,00", "salarioDeseado" => "20000,00");
    } else  if ($_GET['typeform'] == 'preloadIrreal') {
        $params = array("name" => "Alien", "surname" => "Predator", "sexo" => "Mandaloriano", "date" => "1968-06-20", "place" => "Tatooine", "email" => "tatooine@proton.es", "phone" => "+34 666 33 66 55", "url" => "https://darebee.com/", "html" => "4", "mySQL" => "9", "ingles" =>  "8", "php" => "7", "javascript" => "8", "LMSGI" => "checked", "BBDD" => "checked", "SSII" => "checked", "ED" => "checked", "DWEC" => "checked", "DIW" => "checked", "salarioActual" => "150000,00", "salarioDeseado" => "200000,00");
    } else  if ($_GET['typeform'] == 'preloadBroken') {
        $params = array("name" => "Alien23", "surname" => "Predator", "sexo" => "Mandaloriano", "date" => "1968-06-20", "place" => "Tatooine", "email" => "tatooine2proton.es", "phone" => "666 33 66 55", "url" => "htps://darebee.com/", "html" => "4", "mySQL" => "9", "ingles" =>  "8", "php" => "7", "javascript" => "8", "LMSGI" => "checked", "PROG" => "checked", "BBDD" => "checked", "DAW" => "checked", "EIE" => "checked", "salarioActual" => "19000,0", "salarioDeseado" => "100580,00");
    } else  if ($_GET['typeform'] == 'preloadBroken2') {
        $params = array("surname" => "Predator", "sexo" => "Mandaloriano", "date" => "1968-06-20", "place" => "Tatooine", "email" => "tatooine2proton.es", "phone" => "666 a33 66 55", "url" => "https\/darebee.com/", "html" => "-4", "mySQL" => "9", "ingles" =>  "*8", "php" => "7", "javascript" => "8", "LMSGI" => "checked", "FOL" => "checked", "BBDD" => "checked", "SSII" => "checked", "DWEC" => "checked", "DAW" => "checked", "EIE" => "checked", "salarioActual" => "1,0", "salarioDeseado" => "10580,00");
    }

    return $params;
}

function loadGender($params)
{
    $gender = array('Hombre', 'Mujer', 'Ballesta', 'Mandaloriano', 'E.T.', 'Gladius', 'Klingon', 'Jawa', 'Tusken', 'Targaryen', 'Oso Panda');
    $lista = '<label for="sexo">Sexo:<select name="sexo" id="sexo" required placeholder="Sexo"></label>';

    if ($params['sexo'] == "" || !(isset($params['sexo']))) {
        $lista .= '<option selected value="0"> Elige una opción </option>';
    }
    for ($i = 0; $i < count($gender); $i++) {
        if ($params['sexo'] == $gender[$i]) {
            $lista .= '<option  selected value="' . $gender[$i] . '">' . $gender[$i] . '</option>';
        } else {
            $lista .= '<option value="' . $gender[$i] . '">' . $gender[$i] . '</option>';
        }
    }

    $lista .= '</select>';

    return $lista;
}

function loadBrokenParamWithoutVerification($params)
{

    $name = '<input type="hidden" name="name" id="name" value="' . $params["name"] . '"/>';
    $surname = '<input type="hidden" name="surname" id="surname" value="' . $params["surname"] . '"/>';
    $sexo = '<input type="hidden" name="sexo" id="sexo" value="' . $params["sexo"] . '"/>';
    $date = '<input type="hidden" name="date" id="date" value="' . $params["date"] . '"/>';
    $place = '<input type="hidden" name="place" id="place" value="' . $params["place"] . '"/>';
    $email = '<input type="hidden" name="email" id="email" value="' . $params["email"] . '"/>';
    $phone = '<input type="hidden" name="phone" id="phone" value="' . $params["phone"] . '"/>';
    $url = '<input type="hidden" name="url" id="url" value="' . $params["url"] . '"/>';
    $html = '<input type="hidden" name="html" id="html" value="' . $params["html"] . '"/>';
    $mySQL = '<input type="hidden" name="mySQL" id="mySQL" value="' . $params["mySQL"] . '"/>';
    $ingles = '<input type="hidden" name="ingles" id="ingles" value="' . $params["ingles"] . '"/>';
    $javascript = '<input type="hidden" name="javascript" id="javascript" value="' . $params["javascript"] . '"/>';
    $php = '<input type="hidden" name="php" id="php" value="' . $params["php"] . '"/>';
    $salary = '<input type="hidden" name="salarioActual" id="salarioActual" value="' . $params["salarioActual"] . '"/>';
    $salaryFuture = '<input type="hidden" name="salarioDeseado" id="salarioDeseado" value="' . $params["salarioDeseado"] . '"/>';


    $typeform = '<input type="hidden" name="typeform" id="typeform" value="' . $_GET['typeform'] . '"/>';



    echo $typeform . $name . $surname . $sexo . $date . $place . $email . $phone . $url . $html . $mySQL . $ingles . $php . $javascript . $salary . $salaryFuture;
}

function reseteo($params)
{
    if (isset($_GET['clear'])) {
        unset($_GET['typeform']);
    }
}

function loadSubjects($subject)
{
    if (isset($subject) && $subject == "checked") {
        echo "checked";
    }
}

function checkFreeTextField($param)
{
    $patternText = "/^([a-zA-Z]{3,30}\s*)$/";
    return checkException(preg_match($patternText, $param), "freeText");
}

function checkBornDate($param)
{
    $campos = preg_split("/[-]+/", $param);
    $bool = false;
    $type = "date";
    if (count($campos) == 3) {
        $bool = checkdate($campos[1], $campos[2], $campos[0]);
    }
    $diff = strtotime(date("Y-m-d")) - strtotime($param);
    if ($diff < 0) {
        $type = "future";
        $bool = false;
    }

    return checkException($bool, $type);
}

function checkIsNaturalNumber($param)
{
    $patternNumber = "/^([1-9]|10)$/";
    return checkException(preg_match($patternNumber, $param), "number");
}

function unichr($u)
{
    return mb_convert_encoding('&#' . intval($u) . ';', 'UTF-8', 'HTML-ENTITIES');
}

function checkIsSalary($param)
{
    $patternSalary = "/^[0-9]*\,[0-9][0-9]" . unichr(8364) . "$/";

    return checkException(preg_match($patternSalary, htmlspecialchars($param)), "salary");
}
function checkIsEmail($param)
{
    $patternEmail = "/^[A-Z0-9a-z._%+-]+@[A-Za-z0-9.-]+\\.[A-Za-z]{2,64}$/";
    return checkException(preg_match($patternEmail, $param), "email");
}
function checkIsUrl($param)
{
    $patternWeb = "/^(https?:\/\/)?(www\.)?([a-zA-Z0-9]+(-?[a-zA-Z0-9])*\.)+[\w]{2,}(\/\S*)?$/";
    return checkException(preg_match($patternWeb, $param), "web");
}
function checkIsSubject($param)
{
    $subjects = array("LMSGI", "FOL", "PROG", "BBDD", "SSII", "ED", "DWEC", "DAW", "EIE", "DIW");
    $bool = false;
    foreach ($subjects as $key => $value) {
        if ($value === $param) {
            $bool = true;
        }
    }

    return checkException($bool, "subject");
}

function checkBirthPlace($param)
{
    $patternBirthPlace = "/^.*(?=.*[A-ZÑñáéíóúÁÉÍÓÚa-z]).$/";
    return checkException(preg_match($patternBirthPlace, $param), "place");
}

function checkSex($param)
{
    $gender = array("Hombre", 'Mujer', 'Ballesta', 'Mandaloriano', 'E.T.', 'Gladius', 'Klingon', 'Jawa', 'Tusken', 'Targaryen', 'Oso Panda');
    $bool = false;
    foreach ($gender as $key => $value) {
        if ($value === $param) {
            $bool = true;
        }
    }

    return checkException($bool, "sex");
}

function checkIsPhone($param)
{
    $patternPhone = "/^(\+34|0034|34)?[\s|\-|\.]?[6|7|8|9][\s|\-|\.]?([0-9][\s|\-|\.]?){8}$/";

    return checkException(preg_match($patternPhone, $param), "phone");
}

function checkException($bool, $type)
{
    if (!$bool) {
        switch ($type) {
            case 'freeText':
                return "<label style='color:red'>Error en el formato de texto.Solo se admiten letras.</label>";
                break;
            case 'date':
                return "<label style='color:red'>Error en el formato de la fecha. Use el selector de fechas o use el formato adecuado. I.E.: 1968-06-20</label>";
                break;
            case 'future':
                return "<label style='color:red'>Error se ha introducido una fecha del futuro.</label>";
                break;
            case 'number':
                return "<label style='color:red'>Error en el formato del campo numero.Solo se admiten valores del 1 al 10</label>";
                break;
            case 'salary':
                return "<label style='color:red'>Error en el formato del campo salario.Solo se admiten valores numericos y con 2 decimales. I.E.: 15000,58€</label>";
                break;
            case 'email':
                return "<label style='color:red'>Error en el formato del email.I.E.: test@test.net</label>";
                break;
            case 'web':
                return "<label style='color:red'>Error en el formato del sitio web.I.E: http://darebee.com</label>";
                break;
            case 'subject':
                return "<label style='color:red'>Error en la asignatura no existe en el plan docente.</label>";
                break;
            case 'place':
                return "<label style='color:red'>Error se ha insertado un caracter no válido.</label>";
                break;
            case 'sex':
                return "<label style='color:red'>Error se ha insertado sexo no existente.</label>";
                break;
            case 'phone':
                return "<label style='color:red'>Error se ha insertado telefono no valido. I.E: +34 666 66 66 66 ó +34666666666</label>";
                break;
            default:
                return "<label style='color:red'>Error no controlado</label>";
                break;
        }
    }
}

function subjectsDefine()
{
    $subjectsByDefault = array("LMSGI", "FOL", "PROG", "BBDD", "SSII", "ED", "DWEC", "DAW", "EIE", "DIW");
    $subjects = array();
    foreach ($subjectsByDefault as $key => $value) {
        if (isset($_GET[$value])) {
            array_push($subjects, $_GET[$value]);
        }
    }

    return $subjects;
}

function age($param)
{

    return date_diff(date_create($param), date_create(date("Y-m-d")));
}

function generateStory()
{

    $name = $_GET["name"];
    $surname = $_GET["surname"];
    $sexo = $_GET["sexo"];
    $date = $_GET["date"];
    $place = $_GET["place"];
    $email = $_GET["email"];
    $phone = $_GET["phone"];
    $url = $_GET["url"];
    $subjects = subjectsDefine();
    $knows = array("html" => $_GET["html"], "mysql" => $_GET["mySQL"], "ingles" => $_GET["ingles"], "php" => $_GET["php"], "javascript" => $_GET["javascript"]);
    $salary = $_GET["salarioActual"];
    $salaryFuture = $_GET["salarioDeseado"];

    $isSet = isset($_GET["name"]) && isset($_GET["surname"]) && isset($_GET["sexo"]) && isset($_GET["date"]) && isset($_GET["place"]) && isset($_GET["email"]) && isset($_GET["phone"]) && isset($_GET["url"]) && isset($_GET["salarioActual"]) && isset($_GET["salarioDeseado"]);

    $isBroken = empty(checkFreeTextField($_GET["name"])) && empty(checkFreeTextField($_GET["surname"])) && empty(checkSex($_GET["sexo"])) && empty(checkBornDate($_GET["date"])) && empty(checkBirthPlace($_GET["place"])) && empty(checkIsEmail($_GET["email"])) && empty(checkIsPhone($_GET["phone"])) && empty(checkIsUrl($_GET["url"])) && empty(checkIsNaturalNumber($knows['html'])) && empty(checkIsNaturalNumber($knows['php'])) && empty(checkIsNaturalNumber($knows['mysql'])) && empty(checkIsNaturalNumber($knows['ingles'])) && empty(checkIsNaturalNumber($knows['javascript'])) && empty(checkIsSalary($salary)) && empty(checkIsSalary($salaryFuture));

    if ($isSet && $isBroken) {
        $fecha = preg_split("/[-]+/", $date);
        $edad = age($date)->format('%y');
        $story = "Hoy en 6º Milenio tenemos una historia que contarles, he mos hablado con el protagonista y ha cedido no ocultar su información. Asi que comencemos esta horripilante historia.<br>";
        $story .= $name . " " . $surname . " es " . $sexo . " por lo tanto ha nacido en " . $place . " el " . $fecha[2] .  " del mes " . $fecha[1] . " en el año " . $fecha[0] . " por lo que tiene " . $edad . "<br/>";
        $story .= "Según nos comenta esta quemado de sus estudios... Tiene aprobados " . count($subjects) . " y no hace mas que pensar en el dia que acabe el ciclo. Ha sido un sitio donde ha conocido a mucha gente y aprendido bastantes cosas pero quiere acabar de una vez...";

        $story .= "Nos comenta que tiene ya aprobados <ul>";
        foreach ($subjects as $key => $value) {
            $story .= "<li>" . $value . "</li>";
        }
        $story .= "</ul>";
        $story .= "<br/> Lo bueno de esto es que al sumar los modulos y sus conocimientos previos: ";
        foreach ($knows as $key => $value) {
            $story .= "<li>" . $key . " = " . $value . "</li>";
        }
        $mana = 0;
        foreach ($knows as $key => $value) {
            $mana += $value;
        }
        $mana *= 5;
        $ataque = count($subjects) * 8;
        $defensa = count($subjects) * 6 - 20;
        $story .= "Obtenemos las siguientes puntuaciones de Mana, Defensa y Ataque.<br/>";
        $story .= "Maná:" . $mana . "<br/>";
        $story .= "Ataque:" . $ataque . "<br/>";
        $story .= "Defensa:" . $defensa . "<br/>";
        $story .= "Asi que tras Mucho tiempo podra luchar contra el jefe de la Liga Pokemon, el cual es colega de Gandalf y este siempre le echa una mano el muy j*****. <br/>";
        $story .= "Pues nada aqui estamos en la inscripcion en la cual pondra nuestro amigo su email: " . $email . ", su telefono: " . $phone . " y tambien pide web  de la que sea propietario. Como no tiene pagina web, coge su web favorita y asi hace un poco de Spam, " . $url . "<br/>";
        $story .= "Hay que recordar que el ganar la liga pokemon hace que la seguridad social te suba el salario de manera instantanea, en el caso de nuestro amigo su salario esta en: " . $salary . " por lo que espera que dicho salario suba como minimo a : " . $salaryFuture . "<br/>";
    } else if (!$isSet) {
        $story = "MECK MECK Puede que algun campo no lo hasya rellenado, revisalo de nuevo porfis";
    } else if (!$isBroken) {
        $story = "Vaya parece que hay errores en los campos que has rellenado. Revisa junto a cada campo porque ha petado.";
    }

    return $story;
}



function autoevaluacion()
{

    $archivo = fopen("./resources/Hidalgo_Arriaga_Ubaldo_DWES1_Auto-evaluacion.csv", "r");

    $table = "<thead><tr><th>Item</th><th>Nota Maxima</th><th>Nota Alumno</th><th>Nota Profesor</th><th>Observaciones</th></tr></thead>";

    /*     if (isset($_GET['send'])) {
        $result = autoevUser($archivo, $table);
    } else { */
    $result = lineToLine($archivo, $table);
    /*   }/*  */


    fclose($archivo);
    return  $result;
}

function lineToLine($archivo, $table)
{
    $notaAlumno = 0;
    $notaProfesor = 0;
    $itemNum = 1;


    while (($linea = fgets($archivo)) !== false) {

        $datos = explode(";", $linea);

        $item = $datos[0];
        $notaMax = $datos[1];
        $alumno = str_replace(",", ".", $datos[2]);
        $profesor = str_replace(",", ".", $datos[3]);
        $observaciones = $datos[4];

        //cargamos valores en la tabla


        $elementAlum = "itemAlum" . $itemNum;
        $elementProf = "itemProf" . $itemNum;
        $elementObs = "obs" . $itemNum;
        $table .= "<tr><td>" . $item . "</td>";
        $table .= "<td style='text-align:center'>" . $notaMax . "</td>";
        if (isset($_GET[$elementAlum])) {

            if ($itemNum == "15") {
                $table .= "<td><input type='number' name='itemAlum" . $itemNum . "' value='" . $_GET[$elementAlum] . "' min='-10' max='0' step='0.2' ></input></td>";
            } else {
                $table .= "<td><input type='number' name='itemAlum" . $itemNum . "' value='" . $_GET[$elementAlum] . "' min='0'  max='" . str_replace(",", ".", $notaMax) . "' step='0.05' ></input></td>";
            }
            $notaAlumno += $_GET[$elementAlum];
        } else {


            if ($itemNum == "15") {
                $table .= "<td><input type='number' name='itemAlum" . $itemNum . "' value='" . $alumno . "' min='-10'  max='0' step='0.2' ></input></td>";
            } else {
                $table .= "<td><input type='number' name='itemAlum" . $itemNum . "' value='" . $alumno . "' min='0'  max='" . str_replace(",", ".", $notaMax) . "' step='0.05' ></input></td>";
            }

            $notaAlumno += $alumno;
        }
        if (isset($_GET[$elementProf])) {

            if ($itemNum === "15") {
                $table .= "<td><input type='number' name='itemProf" . $itemNum . "'value='" . $_GET[$elementProf] . "' min='-10'  max='0' step='0.2' ></input></td>";
            } else {
                $table .= "<td><input type='number' name='itemProf" . $itemNum . "'value='" . $_GET[$elementProf] . "' min='0'  max='" . str_replace(",", ".", $notaMax) . "' step='0.05' ></input></td>";
            }

            $notaProfesor += $_GET[$elementProf];
        } else {
        
            if ($itemNum === "15") {
                $table .= "<td><input type='number' name='itemProf" . $itemNum . "'value='" . $profesor . "' min='-10'  max='0' step='0.2' ></input></td>";
            } else {
                $table .= "<td><input type='number' name='itemProf" . $itemNum . "'value='" . $profesor . "' min='0'  max='" . str_replace(",", ".", $notaMax) . "' step='0.05' ></input></td>";
            }
            $notaProfesor += $profesor;
        }
        if (isset($_GET[$elementObs])) {
            $table .= "<td><textarea name='obs" . $itemNum . "' rows='4' cols='50'>" . $_GET[$elementObs] . "</textarea></td></tr>";
        } else {
            $table .= "<td><textarea name='obs" . $itemNum . "' rows='4' cols='50'>" . $observaciones . "</textarea></td></tr>";
        }

        $itemNum++;
    }


    return notasTotales($table, $notaAlumno, $notaProfesor);
}

function notasTotales($table, $notaAlumno, $notaProfesor)
{
    $item = "Total";
    $notaMax = 10;
    $alumno = str_replace(",", ".", $notaAlumno);
    $profesor = str_replace(",", ".", $notaProfesor);


    $table .= "<tr><td>" . $item . "</td>";
    $table .= "<td style='text-align:center'>" . $notaMax . "</td>";
    $table .= "<td><input type='number' name='alumnoTotal' value='" . $alumno . "' min='0'  max='" . str_replace(",", ".", $notaMax) . "' step='0.05' ></input></td>";
    $table .= "<td><input type='number' name='profesorTotal' value='" . $profesor . "' min='0'  max='" . str_replace(",", ".", $notaMax) . "' step='0.05' ></input></td>";
    $table .= "<td style='background-color:grey;'></td></tr>";
    return $table;
}
