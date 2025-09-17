<?php
session_start();
if(!$_SESSION['email']){
header('location:../cliente/login.php');
exit();
} ?>


