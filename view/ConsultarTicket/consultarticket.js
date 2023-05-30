var usu_id = $('#user_idx').val();
var rol_id = $('#rol_idx').val();

function init(){
    $("#asigna_form").on("submit",function(e)
    {
      guardar(e);
    });
}

$(document).ready(function(){
   
   // console.log(usu_id);
    if(rol_id==1){
        tabla=$('#ticket_data').dataTable({
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
                url:'../../controller/ticket.php?op=listar_x_usu',
                type: "post",
                dataType: "json",
                data: {usu_id: usu_id},
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
    }
    else
    {
        tabla=$('#ticket_data').dataTable({
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
                url:'../../controller/ticket.php?op=listar',
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
        
    }

    $.post("../../controller/usuario.php?op=listar_x_rol",function(data,status){
        $('#usu_asigna').html(data);
       // console.log(data);
      });    


});

function asignar(tick_id){
    $.post("../../controller/ticket.php?op=mostrar",{tick_id:tick_id},function(data,status){
        data = JSON.parse(data);
        $('#tick_id').val(data.tick_id);
        $('#mdltitulo').html('Asignar Agente');
       // console.log(data);
       $('#modalasignarticket').modal('show');
      });    




}

function ver(tick_id){
    console.log(tick_id);
    window.open('http://localhost:8080/PERSONAL_HelpDesk/view/DetalleTicket/?ID='+tick_id+'',"_self");
}

function guardar(e) {
    e.preventDefault();
    var formData = new FormData($("#asigna_form")[0]);
    $.ajax({
      url:"../../controller/ticket.php?op=asignar",
      type:"POST",
      data: formData,
      contentType:false,
      processData:false,
      success: function(e){
        $('#modalasignarticket').modal('hide');
        $('#ticket_data').DataTable().ajax.reload();
      }
    
    });
  }
    
  


init();