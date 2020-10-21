<?php
date_default_timezone_set('America/Argentina/Buenos_Aires');

session_start();
include_once('conexion.php');

class HistorialC{
  public function __construct(){
    $driver = new mysqli_driver();
      $driver->report_mode = MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT;
  }
  public function buscar($post){
    $ret='';
    $ticketid=$post['ticketid'];
    $mysqli = Conexion::abrir();
    $sql = "SELECT u.nombre, u.apellido , h.fechahora, e.descripcion, h.descripcion FROM historial h INNER JOIN usuario u ON u.usuarioid=h.usuarioid INNER JOIN estado e ON e.estadoid=h.estadoid WHERE ticketid=".$ticketid." ORDER BY fechahora desc ";
    $stmt = $mysqli->prepare($sql);
    $stmt->execute();
    $rs = $stmt->get_result();

    if($rs->num_rows>0){

      while($fila=$rs->fetch_array()){
       $ret .= '<hr><div class="row" ><div class="col-md-4"> De: '.$fila[0].' '.$fila[1].'</div><div class="col-md-4"> Fecha: '.$fila[2].'</div><div class="col-md-4"> Estado: '.$fila[3].'</div></div><div class="row"><div class="col-md-12"> Descripcion:<br>'.$fila[4].'</div></div>';
       }

    }
    $stmt->close();
    return $ret;
  }
  public function add($post){
    $arr=array('success'=>false);
    try {
      $hticketid = $post['hticketid'];
      $husuarioid = $_SESSION['UserSession'][0]['Id'];
      $hdescripcion = $post['hdescripcion'];
      $hestado = $post['hestado'];
      $hfechahora = date("Y-m-d H:i:s");
      $mysqli = Conexion::abrir();
      $mysqli->set_charset("utf8");
      $sql = "INSERT INTO historial (ticketid, usuarioid, descripcion, estadoid, fechahora) VALUES (".$hticketid.",".$husuarioid.",'".utf8_encode($hdescripcion)."',".$hestado.",'".$hfechahora."')";
      $stmt2 = $mysqli->prepare($sql);
      $stmt2->execute();
      //
      
      if($stmt2!== FALSE){     
        $estado = 0;    
        //$stmt->bind_param('ississsi',$dusuarioid,$dtitulo,$ddescripcion,$dprioridadid,$dipservidor,$dclaveservidor);
        $stmt2->close();
        $arr = array('success'=>true);
      }
      
    } catch (Exception $e) {
      return $e;
    }
    return $arr;
  }
  
}
?>