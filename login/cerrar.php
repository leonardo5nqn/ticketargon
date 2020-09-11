<?php
session_start();
unset($_SESSION['UserSesion']);
header("Location: ../vista/login.php");
?>