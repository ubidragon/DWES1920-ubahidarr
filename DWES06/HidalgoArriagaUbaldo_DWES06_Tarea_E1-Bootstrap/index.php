<?php
?>

<!DOCTYPE html>

<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<!--     <link rel="stylesheet" type="text/css" href="custom.css" /> -->
    <script src="./include/jquery-3.3.1.min.js"></script>
    <!-- CSS only -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

<!-- JS, Popper.js, and jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
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