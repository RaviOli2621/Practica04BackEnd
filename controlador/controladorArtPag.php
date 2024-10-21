<?php 
//Xavi Rubio Monje
include  "../model/model.php";
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