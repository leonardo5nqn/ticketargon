<?php
//include('controlador/validar.php');
include_once('controlador/usuarioc.php');
include_once('modelo/usuario.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>
    Systickets
  </title>
  <!-- Favicon -->
  <link href="./img/brand/favicon.png" rel="icon" type="image/png">
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <!-- Icons -->
  <link href="./js/plugins/nucleo/css/nucleo.css" rel="stylesheet" />
  <link href="./js/plugins/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link href="./css/argon-dashboard.css?v=1.1.2" rel="stylesheet" />
</head>

<body class="">

    <div id="menu">
  
         <?php 
        //Usuario Administrador
        if (isset($_SESSION['UserSession'][0]['PerfilId']) && $_SESSION['UserSession'][0]['PerfilId']=='1' ) {
          include('vista/menuadmin.php');
        }else{
            //Usuario Cliente
            if (isset($_SESSION['UserSession'][0]['PerfilId']) && $_SESSION['UserSession'][0]['PerfilId']=='2' ) {
              include('vista/menucliente.php');
          }else{
            //Usuario Tecnico
              if (isset($_SESSION['UserSession'][0]['PerfilId']) && $_SESSION['UserSession'][0]['PerfilId']=='3' ) {
                include('vista/menutecnico.php');
              }
              else  {
                include('vista/home.php');
              }    
          }  
        }
        
        ?>

  </div>
  <div id="contenedor">
    
  </div>


</html>