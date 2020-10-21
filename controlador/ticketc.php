<?php
date_default_timezone_set('America/Argentina/Buenos_Aires');

include_once('conexion.php');
include_once('usuarioc.php');

class TicketC{
  public function __construct(){
    $driver = new mysqli_driver();
      $driver->report_mode = MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT;
  }
  public function buscar($post){
    $arr= array();
    $ticketid = $post['param1'];
    $mysqli = Conexion::abrir();
    $sql = "SELECT concat(u.nombre,' ',u.apellido), t.titulo, h.descripcion, p.descripcion, t.ipservidor, t.claveservidor, t.ticketid ,p.prioridadid, t.areaid, t.tecnicoid FROM ticket t INNER JOIN historial h ON h.ticketid=t.ticketid INNER JOIN prioridad p ON p.prioridadid=t.prioridadid INNER JOIN usuario u ON u.usuarioid= t.usuarioid WHERE t.ticketid= ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('i',$ticketid);
    $stmt->execute();
    $rs = $stmt->get_result();
    if($rs->num_rows>0){
      while($fila=$rs->fetch_array()){
        $arr['usuarioid'] = $fila[0];
        $arr['titulo'] = $fila[1];
        $arr['descripcion'] = $fila[2];
        $arr['prioridad'] = $fila[3];
        $arr['ipservidor'] = $fila[4];
        $arr['claveservidor'] = $fila[5];        
        $arr['ticketid'] = $fila[6];
        $arr['prioridadid'] = $fila[7];
        $arr['areaid'] = $fila[8];
        $arr['tecnicoid'] = $fila[9];
        //$_SESSION['sticketid'] = $fila[6];
      }
    }
    $stmt->close();
    return $arr;
  }
  public function listar(){
    $mysqli = Conexion::abrir();
    $arr = array();
    $arr2 = array();
    $sql= "";
    $rol=$_SESSION['UserSession'][0]['PerfilId'];
    //Admin
    if (isset($rol) && $rol=='1' ) {
        
        $sql = "SELECT concat(u.nombre,' ',u.apellido), t.titulo, h.descripcion, p.descripcion, t.ipservidor, t.claveservidor,a.descripcion, t.ticketid, h.historialid 
            FROM ticket t 
            INNER JOIN historial h ON h.ticketid = t.ticketid
            INNER JOIN (SELECT MAX(historialid) historialid,ticketid FROM historial GROUP BY ticketid) hi ON hi.historialid=h.historialid 
            INNER JOIN prioridad p ON p.prioridadid=t.prioridadid 
            INNER JOIN usuario u ON u.usuarioid= t.usuarioid 
            LEFT JOIN area a ON a.areaid=t.areaid WHERE t.estado=0;";
    }
    //Cliente
    if (isset($rol) && $rol=='2') {
      $sql = "SELECT concat(u.nombre,' ',u.apellido), t.titulo, h.descripcion, p.descripcion, t.ipservidor, t.claveservidor,a.descripcion, t.ticketid, h.historialid 
            FROM ticket t 
            INNER JOIN historial h ON h.ticketid = t.ticketid
            INNER JOIN (SELECT MAX(historialid) historialid,ticketid FROM historial GROUP BY ticketid) hi ON hi.historialid=h.historialid 
            INNER JOIN prioridad p ON p.prioridadid=t.prioridadid 
            INNER JOIN usuario u ON u.usuarioid= t.usuarioid 
            LEFT JOIN area a ON a.areaid=t.areaid WHERE t.estado=0 AND t.usuarioid=".$_SESSION['UserSession'][0]['Id'];

    }
    //Tecnico
    if (isset($rol) && $rol=='3') {
      $sql = "SELECT concat(u.nombre,' ',u.apellido), t.titulo, h.descripcion, p.descripcion, t.ipservidor, t.claveservidor,a.descripcion, t.ticketid, h.historialid 
            FROM ticket t 
            INNER JOIN historial h ON h.ticketid = t.ticketid
            INNER JOIN (SELECT MAX(historialid) historialid,ticketid FROM historial GROUP BY ticketid) hi ON hi.historialid=h.historialid 
            INNER JOIN prioridad p ON p.prioridadid=t.prioridadid 
            INNER JOIN usuario u ON u.usuarioid= t.usuarioid 
            LEFT JOIN area a ON a.areaid=t.areaid WHERE t.estado=0 AND t.tecnicoid=".$_SESSION['UserSession'][0]['Id'];

    }
    $stmt = $mysqli->prepare($sql);
    $stmt->execute();
    $rs = $stmt->get_result();
    if($rs->num_rows>0){
      while($fila=$rs->fetch_array()){
        $arr['usuarioid'] = $fila[0];
        $arr['titulo'] = $fila[1];
        $arr['descripcion'] = $fila[2];
        $arr['prioridad'] = $fila[3];
        $arr['ipservidor'] = $fila[4];
        $arr['claveservidor'] = $fila[5] == NULL ? '' : $fila[5];    
        $arr['areaid'] = $fila[6];
        $arr['ticketid'] = $fila[7];        
        $arr2[] = $arr;
      }
    }
    $stmt->close();
    return array('data'=>$arr2,'rol'=>$rol);
  }
  public function add($post){
    $arr=array('success'=>false);
    try {
      $dusuarioid = $_SESSION['UserSession'][0]['Id'];
      $dtitulo = $post['dtitulo'];
      $dprioridad = $post['dprioridadid'];
      $dipservidor = $post['dipservidor'];
      $dclaveservidor = $post['dclaveservidor'] == NULL || $post['dclaveservidor'] == "" ? 'NULL' : $post['dclaveservidor'] ;  
      $mysqli = Conexion::abrir();
      $mysqli->set_charset("utf8");
      $sql = "INSERT INTO ticket (usuarioid, titulo, prioridadid, ipservidor, claveservidor) VALUES (".$dusuarioid.",'".utf8_encode($dtitulo)."',".$dprioridad.",'".$dipservidor."',".$dclaveservidor.")";
      $stmt = $mysqli->prepare($sql);
      $stmt->execute();
      
      //tabla historial
      $dticketid = $stmt->insert_id;
      $dusuarioid = $_SESSION['UserSession'][0]['Id'];
      $ddescripcion = $post['ddescripcion'];
      $destadoid = 1;
      $dfechahora = date("Y-m-d H:i:s");
      $mysqli = Conexion::abrir();
      $mysqli->set_charset("utf8");
      $sql = "INSERT INTO historial (ticketid, usuarioid, descripcion, estadoid, fechahora) VALUES (".$dticketid.",".$dusuarioid.",'".utf8_encode($ddescripcion)."',".$destadoid.",'".$dfechahora."')";
      $stmt2 = $mysqli->prepare($sql);
      $stmt2->execute();
      //
      
      if($stmt!== FALSE){     
        $estado = 0;    
        //$stmt->bind_param('ississsi',$dusuarioid,$dtitulo,$ddescripcion,$dprioridadid,$dipservidor,$dclaveservidor);
        $stmt->close();
        $arr = array('success'=>true);
      }
      
    } catch (Exception $e) {
      return $e;
    }
    return $arr;
  }
  public function eliminar(){
    $ticketid = $_POST['id'];
    $mysqli = Conexion::abrir();
    $sql = "UPDATE ticket SET estado=1 WHERE ticketid = ".$ticketid;
    $stmt = $mysqli->prepare($sql);
      $stmt->execute();
    if($stmt!== FALSE){
      $estado= 0;
      $stmt->close();     
    }
    return;
  }

  public function editar($post){
    $dticketid = $post['dticketid'];
    //$dusuarioid = $post['dusuarioid'];
    $dtitulo = $post['dtitulo'];
    $ddescripcion = $post['ddescripcion'];
    $dprioridad = $post['dprioridad'];
    $dipservidor = $post['dipservidor'];
    $dclaveservidor = $post['dclaveservidor'] == NULL || $post['dclaveservidor'] == "" ? 'NULL' : $post['dclaveservidor'] ;   
    $mysqli = Conexion::abrir();
    $mysqli->set_charset("utf8");
    //ACTUALIZAR TICKET
    $sql = "UPDATE ticket  SET titulo = '".utf8_encode($dtitulo)."', prioridadid='".$dprioridad."', ipservidor='".$dipservidor."', claveservidor=".$dclaveservidor." WHERE ticketid = ".$dticketid;
    $stmt = $mysqli->prepare($sql);
    $stmt->execute();
    //ACTUALIZAR HISTORIAL TICKET
    $sql2 = "UPDATE  historial SET descripcion = '".utf8_encode($ddescripcion)."' WHERE ticketid = ".$dticketid;
    $stmt = $mysqli->prepare($sql2);
    $stmt->execute();
    if($stmt!== FALSE){           
      $stmt->close();
    }
    return;
  }
  public function select(){
    $ret = '';
    $mysqli = Conexion::abrir();
    $sql = "SELECT usuarioid, titulo FROM ticket WHERE estado = 0";
    $stmt = $mysqli->prepare($sql);
    if($stmt!==FALSE){
      $stmt->execute();
      $rs = $stmt->get_result();
      while($fila=$rs->fetch_array()){
        $ret .= '<option value="'.$fila[0].'">'.$fila[1].'</option>';
      }
    }
    return $ret;
  }
  /*public function validar($post){
    try{
      $error = false;
      $us = filter_input(INPUT_POST, 'ticket', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      if($us===FALSE || is_null($us)) $error = true;
      $clave = $post['clave'];
      if(!$error){    
        $mysqli = Conexion::abrir();
        $sql = "SELECT usuario, nombre, apellido FROM usuario ";
        $sql .= "WHERE usuario = ? and clave = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param('ss',$us,$clave);
        $stmt->execute();
        $rs = $stmt->get_result();
        if($rs->num_rows>0){
          while($fila=$rs->fetch_array()){
            $usuario->setUsuario($fila[0]);
            $usuario->setNombre($fila[1]);
            $usuario->setApellido($fila[2]);
          }
        }else{
          $usuario = false;
        }
        //$stmt->close();
      }else{
        $usuario = $error;
      }

    }catch(Exception $e){
      $usuario =  $e->getMessage();
    }
    finally{
      if(isset($stmt))
        $stmt->close();
    }

    return $usuario;
  }*/
}
?>