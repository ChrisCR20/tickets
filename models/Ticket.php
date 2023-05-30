<?php
    class Ticket extends Conectar
    {
        public function insert_ticket($usu_id,$cat_id,$tick_titulo,$tick_descripcion){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="INSERT INTO tm_ticket (usu_id, cat_id, tick_titulo, tick_descripcion,tick_estado,fech_crea, est,usu_asigna,fech_asigna) VALUES (?,?,?,?,'Abierto',now(),'1',NULL,NULL);";
            $sql = $conectar->prepare($sql);
            $sql->bindValue(1,$usu_id);
            $sql->bindValue(2,$cat_id);
            $sql->bindValue(3,$tick_titulo);
            $sql->bindValue(4,$tick_descripcion);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function update_ticket($tick_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE tm_ticket set tick_estado='Cerrado' WHERE tick_id = ? ;";
            $sql = $conectar->prepare($sql);
            $sql->bindValue(1,$tick_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function listar_ticket_x_usu($usu_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT a.tick_id,a.usu_id,a.cat_id, a.tick_titulo, a.tick_descripcion,a.tick_estado,a.fech_crea, c.usu_nom,c.usu_ape,b.cat_nom,
            a.usu_asigna, a.fech_asigna
            FROM tm_ticket a,tm_categoria b, tm_usuario c
            WHERE a.cat_id= b.cat_id AND a.usu_id = c.usu_id AND a.est=1 AND c.usu_id = ?";
            $sql = $conectar->prepare($sql);
            $sql->bindValue(1,$usu_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function listar_ticket(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT a.tick_id,a.usu_id,a.cat_id, a.tick_titulo, a.tick_descripcion,a.tick_estado,a.fech_crea, c.usu_nom,c.usu_ape,b.cat_nom,
            a.usu_asigna,a.fech_asigna
            FROM tm_ticket a,tm_categoria b, tm_usuario c
            WHERE a.cat_id= b.cat_id AND a.usu_id = c.usu_id AND a.est=1 ";
            $sql = $conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function listar_ticketdetalle_x_ticket($tick_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT  a.tickd_id,a.tickd_descrip,a.fech_crea, b.usu_nom,b.usu_ape,b.rol_id
            from td_ticketdetalle a, tm_usuario b
            where a.usu_id = b.usu_id and a.tick_id=?";
            $sql = $conectar->prepare($sql);
            $sql->bindValue(1,$tick_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }
        public function listar_ticket_x_id($tick_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT  a.tick_id,a.usu_id,a.cat_id,a.tick_titulo,a.tick_descripcion,a.tick_estado,a.fech_crea,b.usu_nom,b.usu_ape,c.cat_nom
            from tm_ticket a, tm_usuario b, tm_categoria c
            where a.usu_id = b.usu_id and a.cat_id=c.cat_id and a.tick_id=?";
            $sql = $conectar->prepare($sql);
            $sql->bindValue(1,$tick_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();  
        }

        public function insert_ticket_detalle($tick_id,$usu_id,$tickd_descrip){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="INSERT INTO td_ticketdetalle (tick_id, usu_id, tickd_descrip, fech_crea,est) VALUES (?,?,?,now(),'1');";
            $sql = $conectar->prepare($sql);
            $sql->bindValue(1,$tick_id);
            $sql->bindValue(2,$usu_id);
            $sql->bindValue(3,$tickd_descrip);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        
        public function insert_ticket_detalle_cerrar($tick_id,$usu_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="INSERT INTO td_ticketdetalle (tick_id, usu_id, tickd_descrip, fech_crea,est) VALUES (?,?,'Ticket Cerrado',now(),'1');";
            $sql = $conectar->prepare($sql);
            $sql->bindValue(1,$tick_id);
            $sql->bindValue(2,$usu_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function get_no_ticketsx_usuario($usu_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT COUNT(*) as TOTAL from tm_ticket where usu_id=? ";
            $sql = $conectar->prepare($sql);
            $sql->bindValue(1,$usu_id);
            $sql->execute();
            return $resultado=$sql->fetchAll(); 
        }
        public function get_no_tickets_abiertos($usu_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT COUNT(*) as TOTAL from tm_ticket where usu_id=? and tick_estado='Abierto'";
            $sql = $conectar->prepare($sql);
            $sql->bindValue(1,$usu_id);
            $sql->execute();
            return $resultado=$sql->fetchAll(); 
        }
        public function get_no_tickets_cerrados($usu_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT COUNT(*) as TOTAL from tm_ticket where usu_id=? and tick_estado='Cerrado'";
            $sql = $conectar->prepare($sql);
            $sql->bindValue(1,$usu_id);
            $sql->execute();
            return $resultado=$sql->fetchAll(); 
        }
        public function get_total_tickets(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT COUNT(*) as TOTAL from tm_ticket ";
            $sql = $conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll(); 
        }
        public function get_totaltick_abiertos(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT COUNT(*) as TOTAL from tm_ticket where tick_estado='Abierto'";
            $sql = $conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll(); 
        }
        public function get_totaltick_cerrados(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT COUNT(*) as TOTAL from tm_ticket where tick_estado='Cerrado'";
            $sql = $conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll(); 
        }
        public function get_ticket_grafico(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT b.cat_nom as nom, COUNT(*) as Total from tm_ticket a, tm_categoria b where a.cat_id = b.cat_id and a.est=1
            group by b.cat_nom order by total desc";
            $sql = $conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll(); 
        }
        public function asignar_ticket($tick_id,$usu_asigna){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE tm_ticket set usu_asigna=? , fech_asigna= now() WHERE tick_id = ? ;";
            $sql = $conectar->prepare($sql);
            $sql->bindValue(1,$usu_asigna);
            $sql->bindValue(2,$tick_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

    }
?>