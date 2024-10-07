<?php 

include  "../model/model.php";
    function inserir($titol,$cos)//Funció per inserir dades a la BD
    {
        try
        {
	        $connexio = new PDO('mysql:host=localhost;dbname=pt04_xavi_rubio', 'root', '');
            $insertar = $connexio->prepare("INSERT INTO articles (titol,cos) VALUES(:titol, :cos)");
            $comprobar = $connexio->prepare("SELECT titol, cos FROM articles WHERE titol = :titulo");
                        
            $insertar->bindParam(":titol",$titol);
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
    
    function modificar($titolOr,$titol,$cos)//Funció per modificar dades a la BD
    {
        try
        {
	        $connexio = new PDO('mysql:host=localhost;dbname=pt04_xavi_rubio', 'root', '');
            $actualizar = $connexio->prepare("UPDATE articles SET titol = :titol, cos = :cos WHERE titol = :titolOr");
            $comprobar = $connexio->prepare("SELECT titol, cos FROM articles WHERE titol = :titulo");
                        
            $actualizar->bindParam(":titol",$titol);
            $actualizar->bindParam(":titolOr",$titolOr);
            $actualizar->bindParam(":cos",$cos);
            $comprobar->bindParam(":titulo",$titolOr);
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
                return "<tr><td id=\"ResM\">Nou titol ja existent (si ha recarregat la pagina un cop la feina ja s'ha portat a terme pot sortir aquest misatge)</td></tr>";
            }
            return "<tr><td id=\"ResM\">Titol no existent (si ha recarregat la pagina un cop la feina ja s'ha portat a terme pot sortir aquest misatge)</td></tr>";
        }catch (PDOException $e){ //
            // mostrarem els errors
            return "<tr><td id=\"ResM\">Error: " . $e->getMessage()."</td></tr>";
        }
        
    }
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


    function articles($pagina,$artPag)//Prepara els statements requerits per mostrar els articles en l'inici
    {
        $pagina = ((int)($pagina)-1);
        $artPag = (int)($artPag);
        
        
        $inici = (string)($artPag);
        $final = (string)($pagina*$artPag);
        $connexio = new PDO('mysql:host=localhost;dbname=pt04_xavi_rubio', 'root', '');
        $comprobar = $connexio->prepare("SELECT titol, cos FROM articles LIMIT :inici OFFSET :final");
        $comprobar->bindParam(":inici",$inici,PDO::PARAM_INT);
        $comprobar->bindParam(":final",$final,PDO::PARAM_INT);
        $result = buscarBD($comprobar);
        return $result;
    }
    function cantidad()//Prepara els statements requerits per saver el número de pàgines que es requeriran
    {
        $connexio = new PDO('mysql:host=localhost;dbname=pt04_xavi_rubio', 'root', '');
        $comprobar = $connexio->prepare("SELECT COUNT(*) FROM articles");
        $result = buscarBD($comprobar);
        return $result;
    }
?>