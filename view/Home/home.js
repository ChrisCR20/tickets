function init(){

}
$(document).ready(function() {
    var usu_id =  $('#user_idx').val();
    var rol_id =  $('#rol_idx').val();

    if(rol_id==1){
    $.post("../../controller/ticket.php?op=totaltickxusu",{usu_id:usu_id},function(data){
        data = JSON.parse(data);
        $('#lbltotal').html(data.TOTAL);
        console.log(data);
    });

    $.post("../../controller/ticket.php?op=tickabiertosxusu",{usu_id:usu_id},function(data){
        data = JSON.parse(data);
        $('#lbltotalabiertos').html(data.TOTAL);
        console.log(data);
    });

    $.post("../../controller/ticket.php?op=tickcerradosxusu",{usu_id:usu_id},function(data){
        data = JSON.parse(data);
        $('#lbltotalcerrados').html(data.TOTAL);
        console.log(data);

        $.post("../../controller/usuario.php?op=grafico_usuario",{usu_id:usu_id},function(data){
            data = JSON.parse(data);
            console.log(data);
            new Morris.Bar({
                // ID of the element in which to draw the chart.
                element: 'grafico',
                hideHover:false,
                resize: true,
                // Chart data records -- each entry in this array corresponds to a point on
                // the chart.
                data: data,
                // The name of the data record attribute that contains x-values.
                xkey: 'nom',
                // A list of names of data record attributes that contain y-values.
                ykeys: ['Total'],
                // Labels for the ykeys -- will be displayed when you hover over the
                // chart.
                labels: ['Cantidad'],
              });
        });
    });
    }else{
        $.post("../../controller/ticket.php?op=totaltickets",function(data){
            data = JSON.parse(data);
            $('#lbltotal').html(data.TOTAL);
            console.log(data);
        });
    
        $.post("../../controller/ticket.php?op=totaltickabiertos",function(data){
            data = JSON.parse(data);
            $('#lbltotalabiertos').html(data.TOTAL);
            console.log(data);
        });
    
        $.post("../../controller/ticket.php?op=totaltickcerrados",function(data){
            data = JSON.parse(data);
            $('#lbltotalcerrados').html(data.TOTAL);
            console.log(data);
        });

        
    $.post("../../controller/ticket.php?op=grafico",function(data){
        data = JSON.parse(data);
        console.log(data);
        new Morris.Bar({
            // ID of the element in which to draw the chart.
            element: 'grafico',
            hideHover:false,
            resize: true,
            // Chart data records -- each entry in this array corresponds to a point on
            // the chart.
            data: data,
            // The name of the data record attribute that contains x-values.
            xkey: 'nom',
            // A list of names of data record attributes that contain y-values.
            ykeys: ['Total'],
            // Labels for the ykeys -- will be displayed when you hover over the
            // chart.
            labels: ['Cantidad'],
          });
    });
    }




});


init();