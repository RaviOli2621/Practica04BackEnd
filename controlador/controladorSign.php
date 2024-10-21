<?php 
//Xavi Rubio Monje
function encriptar($contra)
    {
        $contraEncr = password_hash($contra, PASSWORD_DEFAULT);        
        return $contraEncr;    
    }
    function inserir($Correu,$Usuari,$Contrasenya,$Contrasenya2)//Funció per inserir dades a la BD
    {
        include  "../model/model.php";

        //comprovar dades
        if(strlen((preg_replace("/\s+/","",$Usuari)) < 1))
        {
            return "<tr><td id=\"ResM\">Error: nom d'usuari invalid</td></tr>";
        }elseif(preg_match("/[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,5}/",$Correu) == false)
        {
            return "<tr><td id=\"ResM\">Error: error en el format del correu</td></tr>";
        }elseif(strlen((preg_replace("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])[A-Za-z\d$@$!%*?&]{8,15}[^'\s]/","",subject: $Contrasenya)) < 1))
        {
            return "<tr><td id=\"ResM\">Error: contrasenya invalida. Requereix:\n -8 a 15 caracters\n -Una majuscula una minúscula un dígit i un caràcter especial ()\n -Sense espais\n </td></tr>";
        }elseif($Contrasenya != $Contrasenya2)
        {
            return "<tr><td id=\"ResM\">Error: les contrasenyes han de coincidir</td></tr>";
        }

        $Contrasenya = encriptar($Contrasenya);
        //password_verify

        try
        {
	        $connexio = new PDO('mysql:host=localhost;dbname=pt04_xavi_rubio', 'root', '');
            $insertar = $connexio->prepare("INSERT INTO usuaris (Correu,Usuari,Contrasenya) VALUES(:Correu,:Usuari,:Contrasenya)");
            $comprobar = $connexio->prepare("SELECT Correu,Usuari,Contrasenya FROM usuaris WHERE (Correu = :Correu)");
            $comprobar2 = $connexio->prepare("SELECT Correu,Usuari,Contrasenya FROM usuaris WHERE (Usuari = :Usuari)");
                        
            $insertar->bindParam(":Correu",$Correu);
            $insertar->bindParam(":Usuari",$Usuari);
            $insertar->bindParam(":Contrasenya",$Contrasenya);
            $comprobar->bindParam(":Correu",$Correu);
            $comprobar2->bindParam(":Usuari",$Usuari);
            $result = buscarBD($comprobar);
            $result2 = buscarBD($comprobar2);        
            if((empty($result))&&(empty($result2)))
            {
                $result = buscarBD($insertar);
                return "<tr><td id=\"Res\">Operació exitosa</td></tr>";
            }
            return "<tr><td id=\"ResM\">Coinicdencia amb el correu o el usuari</td></tr>";
        }catch (PDOException $e){ //
            // mostrarem els errors
            return "<tr><td id=\"ResM\">Error: " . $e->getMessage()."</td></tr>";
        }
        
    }
    function canviarContr($Correu,$Usuari,$Contrasenya,$NovaCn,$NovaCn2)
    {
        include "controladorLog.php";
        comprovar($Correu,$Usuari,$Contrasenya);
        if(isset($_SESSION['Usuari']))//l'usuari es correcte
        {
            if(strlen((preg_replace("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])[A-Za-z\d$@$!%*?&]{8,15}[^'\s]/","",$NovaCn)) < 1))
            {
                session_destroy();
                setcookie("UsuariLogat", "" , time()-60,"/");
                return "<tr><td id=\"ResM\">Error: contrasenya invalida. Requereix:\n -8 a 15 caracters\n -Una majuscula una minúscula un dígit i un caràcter especial ()\n -Sense espais\n </td></tr>";
            }elseif($NovaCn != $NovaCn2)
            {
                session_destroy();
                setcookie("UsuariLogat", "" , time()-60,"/");
                return "<tr><td id=\"ResM\">Error: les contrasenyes han de coincidir</td></tr>";
            }

            $NovaCn = encriptar($NovaCn);
            
            $connexio = new PDO('mysql:host=localhost;dbname=pt04_xavi_rubio', 'root', '');
            $modificar = $connexio->prepare("UPDATE usuaris SET Contrasenya = :Contrasenya WHERE Usuari = :Usuari;");
            $modificar->bindParam(":Contrasenya",$NovaCn);
            $modificar->bindParam(":Usuari",$Usuari);
            buscarBD($modificar);
            $_SESSION['Contrasenya'] = $NovaCn;
            return "<tr><td id=\"Res\">Operació exitosa2</td></tr>";
        }
        session_destroy();//si el usuari es incorrecte destruir la sessió
        setcookie("UsuariLogat", "" , time()-60,"/");
        return"<tr><td id=\"ResM\">Error: Usuari incorrecte</td></tr>";
    }
?>