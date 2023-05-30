function init(){

}
$(document).ready(function(){
    var tick_id= getUrlParameter('ID');
    listardetalle(tick_id);




    $('#tickd_descrip').summernote({
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

    $('#tick_descripcion').summernote({
        height:400,
        lang: "es-ES"
    });

    $('#tick_descripcion').summernote('disable');

    

});

var getUrlParameter = function getUrlParameter(sParam) {
    var sPageUrl = decodeURIComponent(window.location.search.substring(1)),
        sURLVariables = sPageUrl.split('&'),
        sParameterName,
        i;

    for(i=0; i<sURLVariables.length;i++){
        sParameterName = sURLVariables[i].split('=');

        if(sParameterName[0] == sParam){
            return sParameterName[1]== undefined ? true: sParameterName[1];
        }
    }
};



$(document).on("click","#btncomentar",function(){
    var tick_id = getUrlParameter('ID');
    var usu_id =  $('#user_idx').val();
    var tickd_descrip =  $('#tickd_descrip').val();

    if($('#tickd_descrip').summernote('isEmpty')){
        swal({
          title: "Advertencia!",
          text: "No se ha detectado ningun comentario",
          type: "warning",
          confirmButtonClass: "btn-danger",
          confirmButtonText: "Ok"
        });
      }else{

    $.post("../../controller/ticket.php?op=insert_detalle",{tick_id : tick_id,usu_id:usu_id,tickd_descrip:tickd_descrip},function(data){
        //console.log(data);
       // $('#lbldetalle').html(data);

       $('#tickd_descrip').summernote('reset');
        swal({
        title: "Envio Correcto!",
        text: "Tu comentario ha sido enviado!",
        type: "success",
        confirmButtonClass: "btn-success",
        confirmButtonText: "Ok"
      },
      function(){
      
        listardetalle(tick_id);
                
      });

     


    });
}

});

$(document).on("click","#btncerrar",function(){
    swal({
        title: "Esta seguro de Cerrar el Ticket?",
        text: "Una vez cerrada la incidencia ya no se podra comentar!",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Si, Cerrar ticket!",
        cancelButtonText: "Cancelar!",
        closeOnConfirm: false,
        closeOnCancel: false
    },
    function(isConfirm) {
        if (isConfirm) {
            var tick_id = getUrlParameter('ID');
            var usu_id = $('#user_idx').val();
            $.post("../../controller/ticket.php?op=update",{tick_id : tick_id, usu_id:usu_id},function(data){

            });
            listardetalle(tick_id);
            swal({
                title: "Ticket Cerrado!",
                text: "Crear un nuevo ticket para reportar otro problema",
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
});

function listardetalle(tick_id){
    $.post("../../controller/ticket.php?op=listardetalle",{tick_id : tick_id},function(data){
        console.log(data);
        $('#lbldetalle').html(data);
    });

    $.post("../../controller/ticket.php?op=mostrar",{tick_id : tick_id},function(data){
        //console.log(data);
        data= JSON.parse(data);
        $('#lblestado').html(data.tick_estado);
        $('#lblnomusuario').html(data.usu_nom+' '+data.usu_ape);
        $('#lblfechcrea').html(data.fech_crea);
        $('#lblnomidticket').html('Detalle Ticket - '+data.tick_id);

        $('#tick_titulo').val(data.tick_titulo);
        $('#cat_nom').val(data.cat_nom);
        $('#tick_descripcion').summernote('code',data.tick_descripcion);

        if(data.tick_estado_texto == "Cerrado")
        {
            $('#paneldetalle').hide();
        }

    });


}

init();