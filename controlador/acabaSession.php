<?php
session_start();
if(!isset($_SESSION["Usuari"]))
{
    $regex = "/index.php$/";
    session_destroy();
    if(!preg_match($regex,$_SERVER['REQUEST_URI'])) header(header: 'Location: ../index.php');
    else header(header: 'Location: '.$_SERVER["PHP_SELF"].'');
}
?>