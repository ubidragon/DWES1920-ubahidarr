$(document).ready(function () {

  clean();
  pintaTabla();

  $(document).on('click', '#insertButton', (e) => {
    let element = $(this)[0].activeElement.parentElement.parentElement;
    modalGenerico(element, 'insert');
  });

  $(document).on('click', '.edit', (e) => {
    let element = $(this)[0].activeElement;
    let id = $(element).attr('id');
    modalGenerico(id, 'edit');
  });

  $(document).on('click', '.delete', (e) => {
    let element = $(this)[0].activeElement;
    let id = $(element).attr('id');
    modalGenerico(id, 'delete');
  });

  $(document).on('click', '#accionProducto', (e) => {
    modal.style.display = "none";
    accion = document.getElementsByName("accionProducto")[0].value
    elemento = document.getElementsByClassName("clean");
    // console.log(accion);
    operaciones(accion, elemento);
  });

});

/**
 * Se intenta realizar un modal generico para ser reutilizado segun que ocasion. No es la forma mas elegante de hacerlo para un producto final pero para un entorno academico como es el de este modulo sirve.
 */

function modalGenerico(id, tipo) {
  clean();
  var span = document.getElementsByClassName("close")[0];
  var modal = document.getElementById("modal");

  modal.style.display = "block";

  span.onclick = function () {
    modal.style.display = "none";
  }
  window.onclick = function (event) {
    if (event.target == modal) {
      modal.style.display = "none";
    }
  }

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
    $("#msg").html('¿Esta seguro de eliminar este producto?');
  } else if (tipo == 'edit') {
    $("#accionProducto").html('Editar Producto').val('editar');
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

  let codProducto = "";
  let articulo = Array();
  let stock = "";


    for (let item of elemento) {
      articulo.push(item.value);
    }

  let dataProducto = {
    "accionProducto" : accion,
    "articulo" : articulo
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
            <td id="${producto.codigo}">${producto.codigo}</td> 
            <td id="name-${producto.codigo}">${producto.nombre}</td>
            <td id="desc-${producto.codigo}">${producto.descripcion}</td> 
            <td id="pvp-${producto.codigo}">${producto.PVP}</td> 
            <td id="fam-${producto.codigo}">${producto.familia}</td>
            <td id="stock-${producto.codigo}">${producto.stock}</td>                    
            <td style="width: 10%" >
              <button class="edit" style="width: 48%" type="submit" formmethod="post" name="editButton" id="${producto.codigo}" formaction="">
                <img style="display: block; margin-left: auto;  margin-right: auto; " src="./include/create.svg" alt="Editar">
              </button>
              <button class="delete" style="width: 48%" type="submit" name="deleteButton"  id="${producto.codigo}"formmethod="post" formaction="">
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

/**Trash */

// function muestraModal(){

//   var insertBtn = document.getElementById("insertButton");
//   var editBtn = document.getElementsByClassName("editProduct");
//   var deleteBtn = document.getElementsByClassName("deleteProduct");;

//   modalGenerico(insertBtn);

//   for (let item of editBtn) {
//     modalGenerico(document.getElementById(item.id));
//   }

//   for (let item of deleteBtn) {
//     modalGenerico(document.getElementById(item.id));
//   }

// }

//     $('#task-form').submit(e => {
//       e.preventDefault();
//       const postData = {
//         name: $('#name').val(),
//         description: $('#description').val(),
//         id: $('#taskId').val()
//       };
//       const url = edit === false ? 'task-add.php' : 'task-edit.php';
//       console.log(postData, url);
//       $.post(url, postData, (response) => {
//         console.log(response);
//         $('#task-form').trigger('reset');
//         fetchTasks();
//       });
//     });

// Get a Single Task by Id 
// $(document).on('click', '.task-item', (e) => {
//   const element = $(this)[0].activeElement.parentElement.parentElement;
//   const id = $(element).attr('taskId');
//   $.post('task-single.php', {id}, (response) => {
//     const task = JSON.parse(response);
//     $('#name').val(task.name);
//     $('#description').val(task.description);
//     $('#taskId').val(task.id);
//     edit = true;
//   });
//   e.preventDefault();
// });
//     // Delete a Single Task
//     $(document).on('click', '.task-delete', (e) => {
//       if(confirm('Are you sure you want to delete it?')) {
//         const element = $(this)[0].activeElement.parentElement.parentElement;
//         const id = $(element).attr('taskId');
//         $.post('task-delete.php', {id}, (response) => {
//           fetchTasks();
//         });
//       }
//     });