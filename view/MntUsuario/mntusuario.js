var tabla;

function init(){
    $("#usuario_form").on("submit",function(e)
    {
      guardaryeditar(e);
    });
}

function guardaryeditar(e) {
    e.preventDefault();
    var formData = new FormData($("#usuario_form")[0]); 
    $.ajax({
        url:"../../controller/usuario.php?op=guardaryeditar",
        type:"POST",
        data: formData,
        contentType:false,
        processData:false,
        success: function(e){
            $('#usuario_form')[0].reset();
            $('#modalmntusuario').modal('hide');
            $('#usuario_data').DataTable().ajax.reload();
            
          swal({
            title: "Completado!",
            text: "La tarea se realizo satisfactoriamente!",
            type: "success",
            confirmButtonClass: "btn-success",
            confirmButtonText: "Ok"
          }); 
        }
      });
    

}

$(document).ready(function(){
   
   // console.log(usu_id);

        tabla=$('#usuario_data').dataTable({
            "aProcessing": true,
            "aServerSide": true,
            dom: 'Bfrtip',
            "searching": true,
            lengthChange: false,
            colReorder: true,
            buttons: [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdfHtml5'
    ,        ],
            "ajax":{
                url:'../../controller/usuario.php?op=listar',
                type: "post",
                dataType: "json",
                error: function(e){
                  //  console.log(e.responseText);
                }
            },
            "bDestroy": true,
            "responsive": true,
            "bInfo": true,
            "iDisplayLength": 10,
            "autoWidth": false,
            "language":{
                "sProcessing": "Procesando.."
            }
        }).DataTable();
   
});

function editar(usu_id){
    $('#mdltitulo').html('Editar Registro');
    $.post("../../controller/usuario.php?op=mostrar",{usu_id:usu_id},function(data){
        data = JSON.parse(data);

        $('#usu_id').val(data.usu_id);
        $('#usu_nom').val(data.usu_nom);
        $('#usu_ape').val(data.usu_ape);
        $('#usu_correo').val(data.usu_correo);
        $('#usu_pass').val(data.usu_pass);
        $('#rol_id').val(data.rol_id).trigger('change');
        //console.log(data);
    });

    $('#modalmntusuario').modal('show');
}

function eliminar(usu_id){
    swal({
        title: "Advertencia!",
        text: "Esta seguro de eliminar el usuario?",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Si, Eliminar Usuario!",
        cancelButtonText: "Cancelar!",
        closeOnConfirm: false,
        closeOnCancel: false
    },
    function(isConfirm) {
        if (isConfirm) {
          //  var usu_id = $('#user_idx').val();
            $.post("../../controller/usuario.php?op=delete",{usu_id:usu_id},function(data){

            });
         //   listardetalle(tick_id);
            $('#usuario_data').DataTable().ajax.reload();
            swal({
                title: "Usuario Eliminado!",
                text: "El usuario ya no aparecerá en el sistema",
                type: "success",
                confirmButtonClass: "btn-success"
            });
        } else {
            swal({
                title: "Cancelado",
                text: "La acción fue cancelada",
                type: "error",
                confirmButtonClass: "btn-danger"
            });
        }
    });
}

$(document).on("click","#btnnuevousuario",function(){
    $('#mdltitulo').html('Nuevo Registro');
    $('#usuario_form')[0].reset();
    $('#modalmntusuario').modal('show');
});
init();