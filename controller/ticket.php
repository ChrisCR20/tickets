<?php
    require_once("../config/conexion.php");
    require_once("../models/Ticket.php");

    $ticket = new Ticket();

    require_once("../models/Usuario.php");

    $usuario = new Usuario();

    switch ($_GET["op"]) {
        case "insert":
            $ticket = $ticket->insert_ticket($_POST["usu_id"],$_POST["cat_id"],$_POST["tick_titulo"],$_POST["tick_descripcion"]);

        break;
        case "update":
          $ticket->update_ticket($_POST["tick_id"]);
          $ticket->insert_ticket_detalle_cerrar($_POST["tick_id"],$_POST["usu_id"]);
        break;
        case "listar_x_usu":
            $datos=$ticket->listar_ticket_x_usu($_POST["usu_id"]);
            $data = Array();
            foreach ($datos as $row) {
                $sub_array = array();
                $sub_array[]= $row["tick_id"];
                $sub_array[]= $row["cat_nom"];
                $sub_array[]= $row["tick_titulo"];
                if($row["tick_estado"]=="Abierto")
                {
                    $sub_array[]= '<span class="label label-pill label-success">Abierto</span>';
                }else
                {
                    $sub_array[]= '<span class="label label-pill label-danger">Cerrado</span>';
                }
                if($row["fech_asigna"]==null)
                {
                    $sub_array[]= '<span class="label label-pill label-default">Sin asignar</span>';
                }else
                {
                    $sub_array[]= date('d/m/Y H:i:s', strtotime($row["fech_asigna"]));
                }
                if($row["usu_asigna"]==null)
                {
                    $sub_array[]= '<span class="label label-pill label-default">Sin asignar</span>';
                }else
                {
                    $datos1=$usuario->get_usuario_x_id($row["usu_asigna"]);
                    foreach($datos1 as $row1)
                    {
                        $sub_array[]= '<span class="label label-pill label-success">'.$row1["usu_nom"].'</span>';
                    }
                }
            

               // $sub_array[]= $row["tick_estado"];
               // $sub_array[]= date_format($row["fech_crea"],'d/m/Y H:i:s');
                $sub_array[]= date('d/m/Y H:i:s',strtotime($row["fech_crea"])); 
                $sub_array[]= '<button type="button" onClick="ver('.$row["tick_id"].');" id="'.$row["tick_id"].'" class="btn btn-inline btn-primary btn-sm ladda-button"><div><i class="fa fa-eye"></i></div></button>';
                $data[]=$sub_array;

            } 

            $results = array(
                "sEcho"=>1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecors"=>count($data),
                "aaData"=>$data);
                echo json_encode($results);
            
        break;
        case "listar":
            $datos=$ticket->listar_ticket();
            $data = Array();
            foreach ($datos as $row) {
                $sub_array = array();
                $sub_array[]= $row["tick_id"];
                $sub_array[]= $row["cat_nom"];
                $sub_array[]= $row["tick_titulo"];
                if($row["tick_estado"]=="Abierto")
                {
                    $sub_array[]= '<span class="label label-pill label-success">Abierto</span>';
                }else
                {
                    $sub_array[]= '<span class="label label-pill label-danger">Cerrado</span>';
                }
                if($row["fech_asigna"]==null)
                {
                    $sub_array[]= '<span class="label label-pill label-default">Sin asignar</span>';
                }else
                {
                    $sub_array[]= date('d/m/Y H:i:s', strtotime($row["fech_asigna"]));
                }
                if($row["usu_asigna"]==null)
                {
                    $sub_array[]= '<a onClick="asignar('.$row["tick_id"].');"><span class="label label-pill label-default">Sin asignar</span></a>';
                }else
                {
                    $datos1=$usuario->get_usuario_x_id($row["usu_asigna"]);
                    foreach($datos1 as $row1)
                    {
                        $sub_array[]= '<a onClick="asignar('.$row["tick_id"].');"><span class="label label-pill label-success">'.$row1["usu_nom"].'</span></a>';
                    }
                }
            
               // $sub_array[]= date_format($row["fech_crea"],'d/m/Y H:i:s');
              //  $sub_array[]= $row["tick_estado"];
                $sub_array[]= date('d/m/Y H:i:s',strtotime($row["fech_crea"])); 
                $sub_array[]= '<button type="button" onClick="ver('.$row["tick_id"].');" id="'.$row["tick_id"].'" class="btn btn-inline btn-primary btn-sm ladda-button"><div><i class="fa fa-eye"></i></div></button>';
                $data[]=$sub_array;

            } 

            $results = array(
                "sEcho"=>1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecors"=>count($data),
                "aaData"=>$data);
                echo json_encode($results);
            
        break;
        case "listardetalle":
            $datos=$ticket->listar_ticketdetalle_x_ticket($_POST["tick_id"]);
            ?>
                <?php
                    foreach($datos as $row)
                    {
                        ?>
                            <article class="activity-line-item box-typical">
                                <div class="activity-line-date">
                                    <?php echo date('d/m/Y ',strtotime($row["fech_crea"])) ?>
                                </div>
                                <header class="activity-line-item-header">
                                    <div class="activity-line-item-user">
                                        <div class="activity-line-item-user-photo">
                                            <a href="#">
                                                <img src="../../public/p<?php echo $row['rol_id']?>.jpg" alt="">
                                            </a>
                                        </div>
                                        <div class="activity-line-item-user-name"> <?php echo $row['usu_nom'].' '.$row['usu_ape'] ?></div>
                                        <div class="activity-line-item-user-status">
                                            <?php
                                                if($row['rol_id']==1)
                                                {
                                                    echo 'Usuario';
                                                }else{
                                                    echo 'Soporte';
                                                }
                                            ?>
                                        </div>
                                    </div>
                                </header>
                                <div class="activity-line-action-list">
                                    <section class="activity-line-action">
                                        <div class="time"><?php echo date('H:i:s',strtotime($row["fech_crea"])) ?></div>
                                        <div class="cont">
                                            <div class="cont-in">
                                                <p><?php echo $row['tickd_descrip'] ?></p>
                                            </div>
                                        </div>
                                    </section><!--.activity-line-action-->
                                </div><!--.activity-line-action-list-->
                            </article><!--.activity-line-item-->
                        <?php
                    }
                ?>
            <?php
        break;
        case "mostrar":
            $datos = $ticket->listar_ticket_x_id($_POST["tick_id"]);
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row)
                {
                    $output["tick_id"]= $row["tick_id"];
                    $output["usu_id"]= $row["usu_id"];
                    $output["cat_id"]= $row["cat_id"];
                    $output["tick_titulo"]= $row["tick_titulo"];
                    $output["tick_descripcion"]= $row["tick_descripcion"];
                    $output["tick_estado_texto"]= $row["tick_estado"];
                    if($row["tick_estado"]=="Abierto")
                    {
                        $output["tick_estado"]= '<span class="label label-pill label-success" id="lblestado">Abierto</span>';
                    }else{
                        $output["tick_estado"]= '<span class="label label-pill label-danger" id="lblestado">Cerrado</span>';
                    }
                    
                    $output["fech_crea"]=  date('d/m/Y H:i:s',strtotime($row["fech_crea"]));
                    $output["usu_nom"]= $row["usu_nom"];
                    $output["usu_ape"]= $row["usu_ape"];
                    $output["cat_nom"]= $row["cat_nom"];
                
                }
                echo json_encode($output);
            } 
        break;
        case "insert_detalle":
            $ticket = $ticket->insert_ticket_detalle($_POST["tick_id"],$_POST["usu_id"],$_POST["tickd_descrip"]);
        break;
        case "totaltickxusu":
            $datos = $ticket->get_no_ticketsx_usuario($_POST["usu_id"]);
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row)
                {   
                    $output["TOTAL"]= $row["TOTAL"];
                 }
                echo json_encode($output);
                } 
        break;
        case "tickabiertosxusu":
            $datos = $ticket->get_no_tickets_abiertos($_POST["usu_id"]);
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row)
                {   
                    $output["TOTAL"]= $row["TOTAL"];
                 }
                echo json_encode($output);
                } 
        break;
        case "tickcerradosxusu":
            $datos = $ticket->get_no_tickets_cerrados($_POST["usu_id"]);
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row)
                {   
                    $output["TOTAL"]= $row["TOTAL"];
                 }
                echo json_encode($output);
                } 
        break;
        case "totaltickets":
            $datos = $ticket->get_total_tickets();
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row)
                {   
                    $output["TOTAL"]= $row["TOTAL"];
                 }
                echo json_encode($output);
                } 
        break;
        case "totaltickabiertos":
            $datos = $ticket->get_totaltick_abiertos();
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row)
                {   
                    $output["TOTAL"]= $row["TOTAL"];
                 }
                echo json_encode($output);
                } 
        break;
        case "totaltickcerrados":
            $datos = $ticket->get_totaltick_cerrados();
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row)
                {   
                    $output["TOTAL"]= $row["TOTAL"];
                 }
                echo json_encode($output);
                } 
        break;
        case "grafico":
            $datos = $ticket->get_ticket_grafico();
            echo json_encode($datos);
        break;
        case "asignar":
            $ticket->asignar_ticket($_POST["tick_id"],$_POST["usu_asigna"]);
        break;

    }


?>