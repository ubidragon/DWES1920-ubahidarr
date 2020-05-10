<?php

?>

<!DOCTYPE html>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="custom.css"/>
        <script src="./include/jquery-3.3.1.min.js"></script> 
        <script src="funciones.js"></script> 
        <title>AJAX - DWES06</title>
    </head>
    <body>
    <div class="topnav">
        <div class="search-container">
            <form >
                <a href="#about">Insertar Producto</a>
                <!-- <input id="buscar" type="text" placeholder="Buscar.." name="buscar">
                <button type="submit">Buscar</button>
                <div id="producto-result">
                    <ul id="container"></ul>
                </div> -->
            </form>
        </div>
    </div>  
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
            <tbody id="productos"></tbody>            
        </table>
        
    </body>
</html>

