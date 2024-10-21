<?php 
//Xavi Rubio Monje
include  "../model/model.php";
ini_set('session.gc_maxlifetime', 40 * 60);
session_start();

    function comprovar($Correu,$Usuari,$Contrasenya)//Funció per inserir dades a la BD
    {

        //password_verify

        try
        {
	        $connexio = new PDO('mysql:host=localhost;dbname=pt04_xavi_rubio', 'root', '');
            $comprobar = $connexio->prepare("SELECT Correu,Usuari,Contrasenya FROM usuaris WHERE (Usuari = :Usuari)");
                        
            $comprobar->bindParam(":Usuari",$Usuari);
            $result = buscarBD($comprobar);        
    
            if((empty($result)))
            {
                return "<tr><td id=\"ResM\">L'usuari no existeix</td></tr>";
            }else
            {
                $correuCheck = false;
                $contrasenyaCheck = false;
                foreach ($result as $dada=>$valor){//
                    foreach ($valor as $dada2=>$valor2){
                        if($dada2 == "Correu")
                        {
                            if($valor2 == $Correu) $correuCheck = true;
                        }
                        if($dada2 == "Contrasenya")
                        {
                            if(password_verify($Contrasenya,$valor2)) $contrasenyaCheck = true;
                        }
                    }                    
                }
            }
            if($contrasenyaCheck == true && $correuCheck == true)
            {
                $_SESSION['Usuari'] = $Usuari;
                $_SESSION['Correu'] = $Correu;
                $_SESSION['Contrasenya'] = $Contrasenya;
                setcookie("UsuariLogat", $Usuari , time()+2400,"/");
                return("<tr><td id=\"Res\">Logat amb exit</td></tr>");
            }
            return("<tr><td id=\"ResM\">Error amb la contrasenya o el correu</td></tr>");
        }catch (PDOException $e){ 
            // mostrarem els errors
            return "<tr><td id=\"ResM\">Error: " . $e->getMessage()."</td></tr>";
        }
        
    }
?>