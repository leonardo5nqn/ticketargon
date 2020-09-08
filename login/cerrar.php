<?php
session_start();
unset($_SESSION['UserSesion']);
header("Location: ../index.php");
?>