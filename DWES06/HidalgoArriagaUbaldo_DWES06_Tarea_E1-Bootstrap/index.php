<?php
?>

<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <!--     <link rel="stylesheet" type="text/css" href="custom.css" /> -->
    <script src="./include/jquery-3.3.1.min.js"></script>
    <!-- CSS only -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <!-- JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"
        integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
        integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
    <!-- DataTables -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js">
    </script>
    <script src="funciones.js"></script>
    <title>AJAX - DWES06</title>
</head>

<body>
    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Insertar Producto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="cod"><b>Codigo</b></label>
                                <input class="form-control clean" type="text" id="cod" name="cod" maxlength="12">
                            </div>
                            <div class="col-md-8">
                                <label for="name"><b>Nombre</b></label>
                                <input class="form-control clean" type="text" id="name" name="name" maxlength="12">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="desc"><b>Descripcion</b></label>
                                <input class="form-control clean" type="text" id="desc" name="descripcion"
                                    maxlength="12">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <label for="pvp"><b>PVP</b></label>
                                <input class="form-control clean" type="number" id="pvp" min="0" step="0.01"
                                    placeholder="PVP" name="pvp" pattern="^[0-9]*\,[0-9][0-9]$" required>
                            </div>

                            <div class="col-md-4">
                                <label for="fam"><b>Familia</b></label>
                                <input class="form-control clean" type="text" id="fam" name="fam" maxlength="6">
                            </div>
                            <div class="col-md-4">
                                <label for="stock"><b>Stock</b></label>
                                <input class="form-control clean" type="number" id="stock" min="0" step="1"
                                    placeholder="Stock" name="stock" pattern="^[0-9]*\,[0-9][0-9]$" required>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-2">

                            </div>
                            <div class="col-md-10">
                                <p class="text-danger" id="msg"></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" name="accionProducto" id="accionProducto" value="insertar"
                        class="btn btn-primary">Insertar Producto</button>
                </div>
            </div>
        </div>
    </div>
            <br />
            <div class="container">
    <div class="d-flex justify-content-center bg-dark text-warning">
        <h1>Amazonia</h1>
    </div>
    <nav class="navbar navbar-light bg-light justify-content-between">
        <div class="form-inline">
            <div class="row">
                <div class="col-md-4">
                    <button class="btn btn-outline-info" data-toggle="modal"
                        data-target="#modalChangeLog">Changelog</button></span>
                </div>
                <div class="col-md-8">
                    <button id="insertButton" class="btn btn-outline-success" data-toggle="modal"
                        data-target="#modal">Insertar Producto</button>
                </div>
                <div class="col-md-4">

                </div>
            </div>
        </div>
        <form class="form-inline">
            <input class="form-control mr-sm-2" type="search" placeholder="Buscar" aria-label="Buscar">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
        </form>
    </nav>
    <form>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <label for="filter-cod"><b>Codigo</b></label>
                    <input class="form-control clean" type="text" id="filter-cod" name="filter-cod" maxlength="12"
                        placeholder="Codigo del producto">
                </div>
                <div class="col-md-4">
                    <label for="filter-name"><b>Nombre</b></label>
                    <input class="form-control clean" type="text" id="filter-name" name="filter-name" maxlength="12"
                        placeholder="Nombre del producto">
                </div>
                <div class="col-md-4">
                    <label for="filter-desc"><b>Descripcion</b></label>
                    <input class="form-control clean" type="text" id="filter-desc" name="filter-descripcion"
                        maxlength="12" placeholder="Descripcion del producto">
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <label for="filter-pvp"><b>PVP</b></label>
                    <input class="form-control clean" type="number" id="filter-pvp" min="0" step="0.01"
                        placeholder="PVP" name="filter-pvp" pattern="^[0-9]*\,[0-9][0-9]$" required>
                </div>

                <div class="col-md-4">
                    <label for="filter-fam"><b>Familia</b></label>
                    <input class="form-control clean" type="text" id="filter-fam" name="filter-fam" maxlength="6">
                </div>
                <div class="col-md-4">
                    <label for="filter-stock"><b>Stock</b></label>
                    <input class="form-control clean" type="number" id="filter-stock" min="0" step="1"
                        placeholder="Stock" name="filter-stock" pattern="^[0-9]*\,[0-9][0-9]$" required>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-4 margin-md-6">
                </div>

                <div class="col-md-4">
                    <button type="button" class="btn btn-primary  btn-block">Busqueda Avanzada</button>
                </div>
            </div>
        </div>
    </form>
    <br>
    <div class="container-fluid">
        <table id="tablaProductos" class=" table-striped  table-bordered">
            <thead>
                <tr>
                    <th scope="col">Código</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Descripcion</th>
                    <th scope="col">PVP</th>
                    <th scope="col">Familia</th>
                    <th scope="col">Stock</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody id="productos"></tbody>
        </table>
    </div>
</body>

</html>