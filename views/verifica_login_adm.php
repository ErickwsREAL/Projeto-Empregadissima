<?php

if(session_status() === PHP_SESSION_NONE){
    session_start();
}

if (empty($_SESSION['administrador'])){
    header("location: index.php");
}

?>