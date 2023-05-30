function init(){
    $("#ticket_form").on("submit",function(e)
    {
      guardaryeditar(e);
    });
}

$(document).ready(function() {
    $('#tick_descripcion').summernote({
        height:400,
        lang: "es-ES",
        popover:{
          image:[],
          link:[],
          air:[]
        },
        callbacks:{
          onImageUpload:function(image){
              myimagetreat(image[0]);
          },
          onPaste: function(e){
              
          }
      }
    });

    $.post("../../controller/categoria.php?op=combo",function(data,status){
      $('#cat_id').html(data);
     // console.log(data);
    });
});

function guardaryeditar(e) {
  e.preventDefault();
  var formData = new FormData($("#ticket_form")[0]);
  if($('#tick_descripcion').summernote('isEmpty') || $('#tick_titulo').val()==''){
    swal({
      title: "Advertencia!",
      text: "(*) campos requeridos",
      type: "warning",
      confirmButtonClass: "btn-danger",
      confirmButtonText: "Ok"
    });
  }else{
  $.ajax({
    url:"../../controller/ticket.php?op=insert",
    type:"POST",
    data: formData,
    contentType:false,
    processData:false,
    success: function(e){
    // console.log(data);
     // alert('nada');
      $('#tick_titulo').val('');
      $('#tick_descripcion').summernote('reset');
      swal({
        title: "Registrado!",
        text: "Tu incidencia ha sido enviada!",
        type: "success",
        confirmButtonClass: "btn-success",
        confirmButtonText: "Ok"
      });

      
      
    }
  
  });
}
  
}

init();

