<?php
session_start();
//unset($_SESSION['UserSesion']);
session_destroy();
header("Location: ../index.php");
?>