<?php
date_default_timezone_set('America/Argentina/Buenos_Aires');

include_once('conexion.php');

class GeneralC{
  public function __construct(){
    $driver = new mysqli_driver();
      $driver->report_mode = MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT;
  }
  public function buscar(){
    $arr= array();
    $mysqli = Conexion::abrir();
    $sql = "SELECT count(ticketid) AS cantticket FROM ticket ";
    $stmt = $mysqli->prepare($sql);
    $stmt->execute();
    $rs = $stmt->get_result();
    
    $sqlasignado = "SELECT count(ticketid) AS cantasignado FROM ticket WHERE (tecnicoid is null or tecnicoid=0) AND (areaid is null or areaid=1)";
    $stmtasignado = $mysqli->prepare($sqlasignado);
    $stmtasignado->execute();
    $rsasignado = $stmtasignado->get_result();

    $sqlalta = "SELECT count(ticketid) AS cantalta FROM ticket WHERE prioridadid=3";
    $stmtalta = $mysqli->prepare($sqlalta);
    $stmtalta->execute();
    $rsalta = $stmtalta->get_result();

    $sqluser = "SELECT count(usuarioid) AS cantuser FROM usuario ";
    $stmtuser = $mysqli->prepare($sqluser);
    $stmtuser->execute();
    $rsuser = $stmtuser->get_result();

    if($rs->num_rows>0 && $rsasignado->num_rows>0 && $rsalta->num_rows>0 && $rsuser->num_rows>0){

      while($fila=$rs->fetch_array()){
        $arr['cantticket'] = $fila[0];
      
      }
      while($fila=$rsasignado->fetch_array()){
        $arr['cantasignado'] = $fila[0];
      
      }
      while($fila=$rsalta->fetch_array()){
        $arr['cantalta'] = $fila[0];
      
      }
      while($fila=$rsuser->fetch_array()){
        $arr['cantuser'] = $fila[0];
      
      }
    }
    $stmt->close();
    return $arr;
  }
  
}
?>