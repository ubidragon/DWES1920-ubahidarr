$(document).ready(function() {
    // Global Settings
    let edit = false;

    pintaTabla();

    function pintaTabla() {
        $.ajax({
        url: 'claseDB.php',
        type: 'POST',
        success: function(response) {

            const productos = JSON.parse(response);
            let tabla = '';
            
            productos.forEach(producto => {
            tabla += `
                    <tr >
                    <td>${producto.codigo}</td> 
                    <td>${producto.nombre}</td>
                    <td>${producto.descripcion}</td> 
                    <td>${producto.PVP}</td> 
                    <td>${producto.familia}</td>
                    <td>${producto.stock}</td>                    
                    <td style="width: 10%" class="task-item"><button style="width: 48%" type="submit" formmethod="post" formaction="cliente.php#buscaEmail"><img style="display: block; margin-left: auto;  margin-right: auto; " src="./include/create.svg" alt="Editar"></button>
                    <button style="width: 48%" type="submit" formmethod="post" formaction="cliente.php#buscaEmail"><img style="display: block; margin-left: auto;  margin-right: auto; " src="./include/delete.svg" alt="Eliminar"></button></td>
                    </tr>
                    `
            });
            $('#productos').html(tabla);
        }
        });
    }




//    $('#prodcuto-result').hide();
// //     // search key type event
//     $('#buscar').keyup(function() {
//       if($('#buscar').val()) {
//         let search = ["buscar", $('#buscar').val()];
//         $.ajax({
//           url: 'claseDB.php',
//           data: {'buscar': search},
//           type: 'POST',
//           success: function (response) {
//             if(!response.error) {
//               let tasks = JSON.parse(response);
//               let template = '';
//               tasks.forEach(task => {
//                 template += `
//                        <li><a href="#" class="producto">${task.nombre}</a></li>
//                       ` 
//               });
//               $('#producto-result').show();
//               $('#container').html(template);
//             }
//           } 
//         })
//       }
//     });
  
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
    $(document).on('click', '.task-item', (e) => {
      const element = $(this)[0].activeElement.parentElement.parentElement;
      const id = $(element).attr('taskId');
      $.post('task-single.php', {id}, (response) => {
        const task = JSON.parse(response);
        $('#name').val(task.name);
        $('#description').val(task.description);
        $('#taskId').val(task.id);
        edit = true;
      });
      e.preventDefault();
    });
  
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
  });
  
  