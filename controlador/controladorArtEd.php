<?php 
//Xavi Rubio Monje
include  "../model/model.php";
    function modificar($titolOr,$titol,$cos)//Funció per modificar dades a la BD
    {
        try
        {
	        $connexio = new PDO('mysql:host=localhost;dbname=pt04_xavi_rubio', 'root', '');
            $actualizar = $connexio->prepare("UPDATE articles SET titol = :titol, cos = :cos WHERE titol = :titolOr");
            $comprobar = $connexio->prepare("SELECT titol, cos FROM articles WHERE titol = :titulo AND Usuari = :Usuari");
                        
            $actualizar->bindParam(":titol",$titol);
            $actualizar->bindParam(":titolOr",$titolOr);
            $actualizar->bindParam(":cos",$cos);
            $comprobar->bindParam(":titulo",$titolOr);
            $comprobar->bindParam(":Usuari",$_SESSION['Usuari']);
            $result = buscarBD($comprobar);
            if((!empty($result)))
            {
                $comprobar->bindParam(":titulo",$titol);
                $result = buscarBD($comprobar);
                if((empty($result)) || $titolOr == $titol)
                {
                    $result = buscarBD($actualizar);
                    return "<tr><td id=\"Res\">Operació exitosa</td></tr>";
                }
                return "<tr><td id=\"ResM\">Nou titol ja existent</td></tr>";
            }
            return "<tr><td id=\"ResM\">Titol no existent o no tens els permisos per editar(si ha recarregat la pagina un cop la feina ja s'ha portat a terme pot sortir aquest misatge)</td></tr>";
        }catch (PDOException $e){ //
            // mostrarem els errors
            return "<tr><td id=\"ResM\">Error: " . $e->getMessage()."</td></tr>";
        }
        
    }
?>