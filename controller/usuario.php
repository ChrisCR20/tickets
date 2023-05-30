<?php
    require_once("../config/conexion.php");
    require_once("../models/Usuario.php");

    $usuario = new Usuario();

    switch ($_GET["op"]) {
        case "guardaryeditar":
            if(empty($_POST["usu_id"])){
             $usuario->insert_usuario($_POST["usu_nom"],$_POST["usu_ape"],$_POST["usu_correo"],$_POST["usu_pass"],$_POST["rol_id"]);
            }else{
                $usuario->update_usuario($_POST["usu_nom"],$_POST["usu_ape"],$_POST["usu_correo"],$_POST["usu_pass"],$_POST["rol_id"],$_POST["usu_id"]);
            }
        break;
        case "delete":
            $usuario = $usuario->delete_usuario($_POST["usu_id"]);
        break;
        case "listar":
            $datos=$usuario->get_usuario();
            $data = Array();
            foreach ($datos as $row) {
                $sub_array = array();
                $sub_array[]= $row["usu_nom"];
                $sub_array[]= $row["usu_ape"];
                $sub_array[]= $row["usu_correo"];
                $sub_array[]= $row["usu_pass"];
                if($row["rol_id"]=="1")
                {
                    $sub_array[]= '<span class="label label-pill label-success">Usuario</span>';
                }else
                {
                    $sub_array[]= '<span class="label label-pill label-info">Soporte</span>';
                }
            
               // $sub_array[]= date_format($row["fech_crea"],'d/m/Y H:i:s');
              //  $sub_array[]= $row["tick_estado"];
               // $sub_array[]= date('d/m/Y H:i:s',strtotime($row["fech_crea"])); 
                $sub_array[]= '<button type="button" onClick="editar('.$row["usu_id"].');" id="'.$row["usu_id"].'" class="btn btn-inline btn-warning btn-sm ladda-button"><div><i class="fa fa-edit"></i></div></button>';
                $sub_array[]= '<button type="button" onClick="eliminar('.$row["usu_id"].');" id="'.$row["usu_id"].'" class="btn btn-inline btn-danger btn-sm ladda-button"><div><i class="fa fa-trash"></i></div></button>';
                $data[]=$sub_array;

            } 

            $results = array(
                "sEcho"=>1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecors"=>count($data),
                "aaData"=>$data);
                echo json_encode($results);
        break;
        case "mostrar":
            $datos = $usuario->get_usuario_x_id($_POST["usu_id"]);
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row)
                {
                    $output["usu_id"]= $row["usu_id"];
                    $output["usu_nom"]= $row["usu_nom"];
                    $output["usu_ape"]= $row["usu_ape"];
                    $output["usu_correo"]= $row["usu_correo"];
                    $output["usu_pass"]= $row["usu_pass"];
                    $output["rol_id"]= $row["rol_id"];

                
                }
            }
                echo json_encode($output);
        break;
        case "grafico_usuario":
            $datos = $usuario->get_ticketusuario_grafico($_POST["usu_id"]);
            echo json_encode($datos);
        break;
        case  "listar_x_rol":
            $datos = $usuario->get_usuario_x_rol();
            if(is_array($datos)==true and count($datos)>0){
              //  $html="<option></option>";
                foreach($datos as $row){
                    $html.= "<option value='".$row['usu_id']."'>".$row['usu_nom']."</option>";
                }
                echo $html;
            } 
        break;
        
    }


    ?>