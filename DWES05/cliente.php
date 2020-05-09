<?php

$uri = "http://" . $_SERVER['SERVER_NAME'] . dirname($_SERVER['REQUEST_URI']);
$url = $uri . "/servicio.php";

$cliente = new SoapClient(null, array('location' => $url, 'uri' => $uri));

$desbloqueados = $cliente->getDesbloqueados();
$fechaActual = date("Y-m-d");

if (isset($_POST['buscarFecha'])) {
    $fecha = $_POST['fecha'];
    $anuncios = $cliente->getEscaparate($fecha);
}else{
    $anuncios = $cliente->getEscaparate($fechaActual);
}
if (isset($_POST['buscarEmail'])) {
    $login = $_POST['login'];
    $email = $cliente->getAnunciantes($login);
    
}

?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="custom.css"/>
        <title>Cliente sin WSDL</title>
    </head>
    <body>
    <form class="formNotBorder">   
		<ul class="navbar">
			<li class="navbarChild"><button type="submit" formmethod="post" formaction="cliente.php#anunciantes">Anunciantes</button></li>
			<li class="navbarChild"><button type="submit" formmethod="post" formaction="cliente.php#escaparate">Escaparate</button></li>
        	<li class="navbarChild"><button type="submit" formmethod="post" formaction="cliente.php#buscaFecha">Buscar Anuncios por Fecha</button></li>
        	<li class="navbarChild"><button type="submit" formmethod="post" formaction="cliente.php#buscaEmail">Buscar Email por Login</button></li>
        	<li class="navbarChild"><button type="submit" formmethod="post" formaction="clientew.php">Ir a clientew</button></li>
           
		</ul>		
    </form>   
    <h1>Clase cliente.php que funciona sin WSDL</h1> 
        <h2 id="buscaEmail">Consulta Email por login:</h2>
        <div class="formulario">
            <form action="cliente.php" method="POST">
                <label for="login">Login:</label>
                <input type="text" id="login" name="login" value="<?php if (isset($_POST['buscarEmail'])) echo $_POST['login']?>" required/><br/>
                <button type="submit" id="buscarEmail" name="buscarEmail" >Buscar Email</button>
            </form>
        </div>
        <div class="container">
            <?php
            if (isset($_POST['buscarEmail'])){
                if (!empty($email)) {                    
                        echo '<h3>El email del usuario es ' . $email . '</h3>';
                } else {
                    echo '<h3>No existe este usuario.</h3>';
                }
            }
            ?>
        </div>       
        <h2 id="anunciantes">Anunciantes</h2>
        <div class="container">
        <?php if (isset($desbloqueados) && !empty($desbloqueados)) { ?>
            <table>
                <thead>
                    <tr>
                        <th>Login</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    <?php   
                    $tabla ="" ;
                        foreach ($desbloqueados as $usuario) {
                            $tabla .='<tr>';
                            $tabla .='<td>' . $usuario['login'] . '</td>';
                            $tabla .='<td>' . $usuario['email'] . '</td>';
                            $tabla .='</tr>';
                        }
                    echo $tabla;
                    ?>
                </tbody>
            </table>
        <?php } else{ ?>
            <h3>No existen Anunciantes Desbloqueados</h3>
        <?php } ?>
        </div>
        <h2 id="buscaFecha">Consulta Anuncios por fecha:</h2>
    <div class="formulario">
            <form action="cliente.php" method="POST">
                <label for="fecha">Fecha:</label>
                <input type="date" id="fecha" name="fecha" value="<?php echo $fechaActual ?>" required/><br/>
                <button type="submit" id="buscarFecha" name="buscarFecha">Buscar anuncios</button>
            </form>
        </div>        
        <h2 id="escaparate">Escaparate</h2>
        <div class="container">
        <?php if (isset($anuncios) && !empty($anuncios)) { ?>
            <table>
                <thead>
                    <tr>
                        <th>Autor</th>
                        <th>Moroso</th>
                        <th>Localidad</th>
                        <th>Descripción</th>
                        <th>Fecha</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $tabla = "";
                        foreach ($anuncios as $anuncio) {
                            $tabla .='<tr>';
                            $tabla .='<td>' . $anuncio['autor'] . '</td>';
                            $tabla .='<td>' . $anuncio['moroso'] . '</td>';
                            $tabla .='<td>' . $anuncio['localidad'] . '</td>';
                            $tabla .='<td>' . $anuncio['descripcion'] . '</td>';
                            $tabla .='<td>' . $anuncio['fecha'] . '</td>';
                            $tabla .='<td>' . $anuncio['email'] . '</td>';
                            $tabla .='</tr>';                        
                        }
                    echo $tabla;
                    ?>
                </tbody>
            </table>
            <?php } else{ ?>
            <h3>No existen Anuncios en el Escaparate para la fecha proporcionada</h3>
        <?php } ?>
        </div>
    </body>
</html>

