<?php
    class Usuario extends Conectar
    {
        public function login()
        {
            $conectar=parent::conexion();
            parent::set_names();
            if(isset($_POST["enviar"])){
                $correo = $_POST["usu_correo"];
                $pass = $_POST["usu_pass"];
                $rol = $_POST["rol_id"];

                if(empty($correo) and empty($pass))
                {
                    header("Location:".conectar::ruta()."/index.php?m=2");
                    exit();
                }else{
                    
                    $sql="SELECT * FROM tm_usuario WHERE usu_correo=? and usu_pass=MD5(?) and rol_id =? and est=1";
                    $stmt=$conectar->prepare($sql);
                    $stmt->bindValue(1,$correo);
                    $stmt->bindValue(2,$pass);
                    $stmt->bindValue(3,$rol);
                    $stmt->execute();
                    $resultado =$stmt->fetch();
                    
                    //log($resultado);

                    if(is_array($resultado) and count($resultado)>0){
                        $_SESSION["usu_id"]=$resultado["usu_id"];
                        $_SESSION["usu_nom"]=$resultado["usu_nom"];
                        $_SESSION["usu_ape"]=$resultado["usu_ape"];
                        $_SESSION["rol_id"]=$resultado["rol_id"];
                        
                        header("Location:".Conectar::ruta()."/view/Home");
                        exit();
                    }else{
                        printf("malo");
                        header("Location:".Conectar::ruta()."/index.php?m=1");
                        exit();
                    }
                    

                }

            }
        }
        
        public function insert_usuario($usu_nom,$usu_ape,$usu_correo,$usu_pass,$rol_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="INSERT INTO tm_usuario(usu_nom,usu_ape,usu_correo,usu_pass,rol_id,fech_crea,est) VALUES (?,?,?,MD5(?),?,now(),'1');";
            $sql = $conectar->prepare($sql);
            $sql->bindValue(1,$usu_nom);
            $sql->bindValue(2,$usu_ape);
            $sql->bindValue(3,$usu_correo);
            $sql->bindValue(4,$usu_pass);
            $sql->bindValue(5,$rol_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }
        public function update_usuario($usu_id,$usu_nom,$usu_ape,$usu_correo,$usu_pass,$rol_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE tm_usuario SET usu_nom=? ,usu_ape=? ,usu_correo=? , usu_pass = ? , rol_id=? where usu_id=?";
            $sql = $conectar->prepare($sql);
            $sql->bindValue(1,$usu_id);
            $sql->bindValue(2,$usu_nom);
            $sql->bindValue(3,$usu_ape);
            $sql->bindValue(4,$usu_correo);
            $sql->bindValue(5,$usu_pass);
            $sql->bindValue(6,$rol_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }
        public function delete_usuario($usu_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE tm_usuario SET est='0', fech_elim=now() where usu_id=?";
            $sql = $conectar->prepare($sql);
            $sql->bindValue(1,$usu_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }
        public function get_usuario(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM tm_usuario WHERE est=1;";
            $sql = $conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }
        public function get_usuario_x_id($usu_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM tm_usuario WHERE est=1 and usu_id=?;";
            $sql = $conectar->prepare($sql);
            $sql->bindValue(1,$usu_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }
        public function get_ticketusuario_grafico($usu_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT b.cat_nom as nom, COUNT(*) as Total from tm_ticket a, tm_categoria b where a.cat_id = b.cat_id and a.est=1 and a.usu_id = ?
            group by b.cat_nom order by total desc";
            $sql = $conectar->prepare($sql);
            $sql->bindValue(1,$usu_id);
            $sql->execute();
            return $resultado=$sql->fetchAll(); 
        }
        public function get_usuario_x_rol(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM tm_usuario WHERE est=1 and rol_id = 2;";
            $sql = $conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }
    }
?>
