<?php 

include  "../model/model.php";
    function eliminar($titol)//Funció per eliminar dades a la BD
    {
        try
        {
	        $connexio = new PDO('mysql:host=localhost;dbname=pt04_xavi_rubio', 'root', '');
            $eliminar = $connexio->prepare("DELETE FROM articles WHERE(titol = :titol)");
            $comprobar = $connexio->prepare("SELECT titol, cos FROM articles WHERE titol = :titulo");
                        
            $eliminar->bindParam(":titol",$titol);
            $comprobar->bindParam(":titulo",$titol);
            $result = buscarBD($comprobar);
            if((!empty($result)))
            {
                $result = buscarBD($eliminar);
                return "<tr><td id=\"Res\">Operació exitosa</td></tr>";
            }
            return "<tr><td id=\"ResM\">Titol no existent (si ha recarregat la pagina un cop la feina ja s'ha portat a terme pot sortir aquest misatge)</td></tr>";
        }catch (PDOException $e){ //
            // mostrarem els errors
            return "<tr><td id=\"ResM\">Error: " . $e->getMessage()."</td></tr>";
        }
        
    }
?>