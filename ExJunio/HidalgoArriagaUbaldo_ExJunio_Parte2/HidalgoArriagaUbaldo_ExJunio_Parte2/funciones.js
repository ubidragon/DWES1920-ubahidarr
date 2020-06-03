$(document).ready(function () {

  clean();

  pintaTabla();

  $(document).on('click', '#insertButton', (e) => {
    let element = this.id;
    modalGenerico(element, 'insert');
  });

  $(document).on('click', '.edit', (e) => {
    let id = this.activeElement.id;
    modalGenerico(id, 'edit');
  });

  $(document).on('click', '.delete', (e) => {
    let id = this.activeElement.id;
    modalGenerico(id, 'delete');
  });

  $(document).on('click', '#actionSearch', (e) => {
    let nombre = $("#basicSearch").val();
    $('#formSearch').show;

  });

  $('#basicSearch').on("keyup input", function () {
    /* Get input value on change */
    var inputVal = $(this).val();
    var resultDropdown = $(this).siblings(".result");
    if (inputVal.length) {

      $.ajax({
        url: 'claseDB.php',
        data: "search=" + inputVal,
        dataType: "json",
        type: 'POST',
        success: function (response) {

          const productos = JSON.parse(response);
          let tabla = '';
          if (productos === null) {
            tabla = "<tr>No hay resultado</tr>";
            
          } else {
            productos.forEach(producto => {
              tabla += `
              <tr >
                  <td scope="row" id="${producto.codigo}">${producto.codigo}</td> 
                  <td scope="row" id="name-${producto.codigo}">${producto.nombre}</td>
                  <td scope="row" id="desc-${producto.codigo}">${producto.descripcion}</td> 
                  <td scope="row" id="pvp-${producto.codigo}">${producto.PVP}</td> 
                  <td scope="row" id="fam-${producto.codigo}">${producto.familia}</td>
                  <td scope="row" id="stock-${producto.codigo}">${producto.stock}</td>                    
                  <td scope="row" style="width: 10%" >
                    <button class="edit" data-toggle="modal" data-target="#modal" type="submit" formmethod="post" name="editButton" id="${producto.codigo}" formaction="">
                      <img style="display: block; margin-left: auto;  margin-right: auto; " src="./include/create.svg" alt="Editar">
                    </button>
                    <button class="delete" data-toggle="modal" data-target="#modal" type="submit" name="deleteButton"  id="${producto.codigo}"formmethod="post" formaction="">
                      <img style="display: block; margin-left: auto;  margin-right: auto; " src="./include/delete.svg" alt="Eliminar">
                    </button>
                  </td>
                </tr>
                `
            });
          }

          $('#productos').html(tabla);    
        }
      });

    } else {
      tabla = "<tr>No hay resultado</tr>";
      $('#productos').html(tabla);    
    }
  });

  $(document).on('click', '#search', (e) => {
    let nombre = $("#basicSearch").val();
    $('#productos').html("");
  });

  $(document).on('click', '#advancedSearch', (e) => {
    let codigo = $("#filter-cod").val();
    let nombre = $("#filter-name").val();
    let descripcion = $("#filter-desc").val();
    let pvp = $("#filter-pvp").val();
    let fam = $("#filter-fam").val();
    let stock = $("#filter-stock").val();
  });




  $(document).on('click', '#accionProducto', (e) => {
    $('#modal').modal('hide');
    accion = document.getElementsByName("accionProducto")[0].value
    elemento = document.getElementsByClassName("clean");
    operaciones(accion, elemento);
  });

});

/**
 * Se intenta realizar un modal generico para ser reutilizado segun que ocasion. No es la forma mas elegante de hacerlo para un producto final pero para un entorno academico como es el de este modulo sirve.
 */

function modalGenerico(id, tipo) {
  clean();

  if (tipo == 'edit' || tipo == 'delete') {
    $('#name').val($('#name-' + id).text()).prop('disabled', true);
    $('#cod').val(id).prop('disabled', true);
    $('#desc').val($('#desc-' + id).text()).prop('disabled', true);
    $('#pvp').val($('#pvp-' + id).text()).prop('disabled', true);
    $('#stock').val($('#stock-' + id).text());
    $('#fam').val($('#fam-' + id).text()).prop('disabled', true);


  }

  if (tipo == 'delete') {
    $('#stock').prop('disabled', true);
    $("#accionProducto").html('Borrar Producto').val('borrar');
    $("#modalTitle").html('Borrar Producto');
    $("#msg").html('¿Esta seguro de eliminar este producto?');
  } else if (tipo == 'edit') {
    $("#accionProducto").html('Editar Producto').val('editar');
    $("#modalTitle").html('Editar Producto').val('editar');
  }

}

function clean() {
  for (let item of document.getElementsByClassName("clean")) {
    let element = "#" + item.id;
    $(element).val('').prop('disabled', false);
  }
  $("#accionProducto").html('Insertar Producto').val('insertar');
  $("#msg").html('');
}

function operaciones(accion, elemento) {

  let articulo = Array();


  for (let item of elemento) {
    articulo.push(item.value);
  }

  let dataProducto = {
    "accionProducto": accion,
    "articulo": articulo
  };

  $.ajax({
    url: 'claseDB.php',
    data: dataProducto,
    dataType: "json",
    type: 'POST',
    success: function () {
      pintaTabla();
    }

  });


}

function pintaTabla() {
  $.ajax({
    url: 'claseDB.php',
    type: 'POST',
    success: function (response) {

      const productos = JSON.parse(response);
      let tabla = '';

      productos.forEach(producto => {
        tabla += `
          <tr >
            <td scope="row" id="${producto.codigo}">${producto.codigo}</td> 
            <td scope="row" id="name-${producto.codigo}">${producto.nombre}</td>
            <td scope="row" id="desc-${producto.codigo}">${producto.descripcion}</td> 
            <td scope="row" id="pvp-${producto.codigo}">${producto.PVP}</td> 
            <td scope="row" id="fam-${producto.codigo}">${producto.familia}</td>
            <td scope="row" id="stock-${producto.codigo}">${producto.stock}</td>                    
            <td scope="row" style="width: 10%" >
              <button class="edit" data-toggle="modal" data-target="#modal" type="submit" formmethod="post" name="editButton" id="${producto.codigo}" formaction="">
                <img style="display: block; margin-left: auto;  margin-right: auto; " src="./include/create.svg" alt="Editar">
              </button>
              <button class="delete" data-toggle="modal" data-target="#modal" type="submit" name="deleteButton"  id="${producto.codigo}"formmethod="post" formaction="">
                <img style="display: block; margin-left: auto;  margin-right: auto; " src="./include/delete.svg" alt="Eliminar">
              </button>
            </td>
          </tr>
          `
      });

      $('#productos').html(tabla);
    }
  });
}