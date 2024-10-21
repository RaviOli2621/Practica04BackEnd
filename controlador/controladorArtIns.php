<?php 
//Xavi Rubio Monje
include  "../model/model.php";
    function inserir($titol,$cos)//Funció per inserir dades a la BD
    {
        try
        {
	        $connexio = new PDO('mysql:host=localhost;dbname=pt04_xavi_rubio', 'root', '');
            $insertar = $connexio->prepare("INSERT INTO articles (titol,Usuari,cos) VALUES(:titol, :Usuari ,:cos)");
            $comprobar = $connexio->prepare("SELECT titol, cos FROM articles WHERE titol = :titulo");
                        
            $insertar->bindParam(":titol",$titol);
            $insertar->bindParam(":Usuari",$_SESSION['Usuari']);
            $insertar->bindParam(":cos",$cos);
            $comprobar->bindParam(":titulo",$titol);
            $result = buscarBD($comprobar);
            if((empty($result)))
            {
                $result = buscarBD($insertar);
                return "<tr><td id=\"Res\">Operació exitosa</td></tr>";
            }
            return "<tr><td id=\"ResM\">Titol ja existent (si ha recarregat la pagina un cop la feina ja s'ha portat a terme pot sortir aquest misatge)</td></tr>";
        }catch (PDOException $e){ //
            // mostrarem els errors
            return "<tr><td id=\"ResM\">Error: " . $e->getMessage()."</td></tr>";
        }
        
    }
?>