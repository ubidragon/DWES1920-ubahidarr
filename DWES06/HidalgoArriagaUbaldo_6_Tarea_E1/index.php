<?php
?>

<!DOCTYPE html>

<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel="stylesheet" type="text/css" href="custom.css" />
    <script src="./include/jquery-3.3.1.min.js"></script>
    <script src="funciones.js"></script>
    <title>AJAX - DWES06</title>
</head>

<body>
    <div class="topnav">
        <div class="search-container">
            <button id="insertButton">Insertar Producto</button>
            <!-- <input id="buscar" type="text" placeholder="Buscar.." name="buscar">
                <button type="submit">Buscar</button>
                <div id="producto-result">
                    <ul id="container"></ul>
                </div> -->
        </div>
    </div>
    <div id="modal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <div class="container">
        
                <label for="cod"><b>Codigo</b></label>
                <input class="clean" type="text" id="cod" name="cod" maxlength="12">
                <label for="name"><b>Nombre</b></label>
                <input class="clean" type="text" id="name" name="name" maxlength="12">
                <label for="desc"><b>Descripcion</b></label>
                <input class="clean" type="text" id="desc" name="descripcion" maxlength="12">
                <label for="pvp"><b>PVP</b></label>
                <input class="clean" type="number" id="pvp" min="0" step="0.01" placeholder="PVP" name="pvp"
                    pattern="^[0-9]*\,[0-9][0-9]$" required>
                <label for="fam"><b>Familia</b></label>
                <input class="clean" type="text" id="fam" name="fam" maxlength="6">
                <label for="stock"><b>Stock</b></label>
                <input class="clean" type="number" id="stock" min="0" step="1" placeholder="Stock" name="stock"
                    pattern="^[0-9]*\,[0-9][0-9]$" required>
            </div>
            <br />
            <div class="container">
                <label id="msg"></label>
                <button class="buttonCenter" type="submit" name="accionProducto" id="accionProducto"
                    value="insertar">Insertar
                    Producto</button>
            </div>
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