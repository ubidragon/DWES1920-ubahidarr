<?php




function paramsPreload($typeform)
{


    if ($_GET['typeform'] == 'preload') {
        $params = array("name" => "Ubaldo", "surname" => "Hidalgo", "sexo" => "Hombre", "date" => "1994-06-20", "place" => "Sevilla", "email" => "ubidragon@protonmail.com", "phone" => "+34 666 33 66 55", "url" => "https://darebee.com/", "html" => "7", "mySQL" => "7", "ingles" => 5, "php" => "2", "javascript" => "8", "LMSGI" => "checked", "FOL" => "checked", "PROG" => "checked", "BBDD" => "checked", "SSII" => "checked", "ED" => "checked", "DWEC" => "checked", "DAW" => "checked", "EIE" => "checked", "DIW" => "checked");
    } else  if ($_GET['typeform'] == 'preloadIrreal') {
        $params = array("name" => "Alien", "surname" => "Predator", "sexo" => "Mandaloriano", "date" => "1968-06-20", "place" => "Tatooine", "email" => "tatooine@proton.es", "phone" => "+34 666 33 66 55", "url" => "https://darebee.com/", "html" => "4", "mySQL" => "9", "ingles" =>  "8", "php" => "7", "javascript" => "8", "LMSGI" => "checked", "BBDD" => "checked", "SSII" => "checked", "ED" => "checked", "DWEC" => "checked", "DIW" => "checked");
    } else  if ($_GET['typeform'] == 'preloadBroken') {
        $params = array("name" => "Alien23", "surname" => "Predator", "sexo" => "Mandaloriano", "date" => "1968-06-20", "place" => "Tatooine", "email" => "tatooine2proton.es", "phone" => "666 33 66 55", "url" => "htps://darebee.com/", "html" => "4", "mySQL" => "9", "ingles" =>  "8", "php" => "7", "javascript" => "8", "LMSGI" => "checked", "PROG" => "checked", "BBDD" => "checked", "DAW" => "checked", "EIE" => "checked");
    } else  if ($_GET['typeform'] == 'preloadBroken2') {
        $params = array("name" => "Alien", "surname" => "Predator", "sexo" => "Mandaloriano", "date" => "1968-06-20", "place" => "Tatooine", "email" => "tatooine2proton.es", "phone" => "666 a33 66 55", "url" => "https\/darebee.com/", "html" => "-4", "mySQL" => "9", "ingles" =>  "*8", "php" => "7", "javascript" => "8", "LMSGI" => "checked", "FOL" => "checked", "BBDD" => "checked", "SSII" => "checked", "DWEC" => "checked", "DAW" => "checked", "EIE" => "checked",);
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
    $php = '<input type="hidden" name="javascript" id="javascript" value="' . $params["javascript"] . '"/>';

    $typeform = '<input type="hidden" name="typeform" id="typeform" value="' . $_GET['typeform'] . '"/>';



    echo $typeform . $name . $surname . $sexo . $date . $place . $email . $phone . $url . $html . $mySQL . $ingles . $php;
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
    if (count($campos) == 3) {
        $bool = checkdate($campos[1], $campos[2], $campos[0]);
    }
    return checkException($bool, "date");
}

function checkIsNumber($param)
{
    $patternNumber = "/^([1-9]|10)$/";
    return checkException(preg_match($patternNumber, $param), "number");
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
            case 'number':
                return "<label style='color:red'>Error en el formato del campo numero.Solo se admiten valores del 1 al 10</label>";
                break;
            case 'email':
                return "<label style='color:red'>Error en el formato del email.<br/>I.E.: test@test.net</label>";
                break;
            case 'web':
                return "<label style='color:red'>Error en el formato del sitio web.<br/>I.E: http://darebee.com</label>";
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
