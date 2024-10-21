<?php
//Xavi Rubio Monje
session_start();
if(isset($_COOKIE["UsuariLogat"]))
{
    $user = $_COOKIE["UsuariLogat"];
    setcookie("UsuariLogat", $user , time()+2400,"/");
}else if(isset($_SESSION["Usuari"]))
{
    echo"siuuuuuuuuuuuuuu";
    $regex = "/index.php$/";
    session_destroy();
    if(!preg_match($regex,$_SERVER['REQUEST_URI'])) header(header: 'Location: ../index.php');
    else header(header: 'Location: '.$_SERVER["PHP_SELF"].'');
}
function salirSinUser()
{
    if(!isset($_SESSION["Usuari"]))
    {
        $regex = "/index.php$/";
        session_destroy();
        if(!preg_match($regex,$_SERVER['REQUEST_URI'])) header(header: 'Location: ../index.php');
        else header(header: 'Location: '.$_SERVER["PHP_SELF"].'');
    }
}





/*if(!isset($_SESSION["Usuari"]))
{
    $regex = "/index.php$/";
    session_destroy();
    if(!preg_match($regex,$_SERVER['REQUEST_URI'])) header(header: 'Location: ../index.php');
    else header(header: 'Location: '.$_SERVER["PHP_SELF"].'');
}*/
?>