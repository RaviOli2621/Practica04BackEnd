<?php 
//Xavi Rubio Monje
include  "../model/model.php";
    function buscar($titol,$cos)//Funció per cercar dades a la BD
    { 
        try
        {
	        $connexio = new PDO('mysql:host=localhost;dbname=pt04_xavi_rubio', 'root', '');
            if($titol != "")
            {
                if($cos != "")
                {
                    $comprobar = $connexio->prepare("SELECT titol, cos FROM articles WHERE titol = :titulo AND cos = :cuerpo");
                    $comprobar->bindParam(":titulo",$titol);
                    $comprobar->bindParam(":cuerpo",$cos);
                }else
                {
                    $comprobar = $connexio->prepare("SELECT titol, cos FROM articles WHERE titol = :titulo");
                    $comprobar->bindParam(":titulo",$titol);
                } 
            }else if($cos != "")
            {
                $comprobar = $connexio->prepare("SELECT titol, cos FROM articles WHERE cos = :cuerpo");
                $comprobar->bindParam(":cuerpo",$cos);
            }else
            {
                $comprobar = $connexio->prepare("SELECT titol, cos FROM articles");
            }
            

            $result = buscarBD($comprobar);
            return $result;
        }catch (PDOException $e){ 
            // mostrarem els errors
            return "<tr><td id=\"ResM\">Error: " . $e->getMessage()."</td></tr>";
        } 
    }
?>