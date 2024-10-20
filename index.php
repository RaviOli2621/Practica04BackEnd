<!DOCTYPE html>
<!--Xavi Rubio Monje-->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Estils/estils.css"/>
    <script src=""></script>
    <title>Index</title>
</head>
<body>
    <?php session_start(); ?>
    <h1 id="titulo">Glossari de termes als jocs de lluita</h1>
    <?php
        
        //cada vez que se toca un boton el tiempo se cierra la sesion, si se toca algo, se renueva el tiempo
        if(isset($_POST['LogOut'])) 
        {
            session_destroy();
        }
        //Depende de si estas logueado te salen unos bottones o otros
        if(isset($_SESSION['Usuari']) && !isset($_POST['LogOut']))
        {
            echo '<div id="circle">
                <div>
                    <h1>'.substr($_SESSION['Usuari'],0,1).'</h1>
                </div>
            </div>';
            include "./Vista/indexVista/Desbloquejat.html";
            //print_r("<h1>".($_SESSION['Tiempo'])."</h1>");
        }else
        {
            include "./Vista/indexVista/Bloquejat.html";
        }
    ?>
</body>
</html>