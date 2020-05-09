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
        	<li class="navbarChild" style="float:right"><button type="submit" formmethod="post" formaction="clientew.php">Ir a clientew</button></li>
           
		</ul>		
    </form>   
        <table>
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Nombre</th>
                    <th>Descripcion</th>
                    <th>PVP</th>
                    <th>Familia</th>
                    <th>Stock</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th>Código</th>
                    <th>Nombre</th>
                    <th>Descripcion</th>
                    <th>PVP</th>
                    <th>Familia</th>
                    <th>Stock</th>
                    <th style="width: 10%"><button style="width: 45%;" type="submit" formmethod="post" formaction="cliente.php#buscaEmail"><img src="./include/create.svg" alt="Editar"></button>
                    <span>
                    <button style="width: 45%;" type="submit" formmethod="post" formaction="cliente.php#buscaEmail"><img src="./include/delete.svg" alt="Eliminar"></button></th>
                </tr>
            </tbody>
        </table>
        
    </body>
</html>

