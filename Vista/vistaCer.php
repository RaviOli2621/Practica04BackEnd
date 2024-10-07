<!DOCTYPE html>
<!--Xavi Rubio Monje-->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Estils/estils.css"/>
    <title>Cercar</title>
</head>
<body>
    <table id="gen" class="table_2">
        <form method="post" action="<?php echo htmlentities($_SERVER["PHP_SELF"]);?>">
            <tr> <!--Titul-->
                <td class="td_2">	
                    <label for="Intrnom">Introdueix el titul del article:</label>		
                </td>
            </tr>
            <tr>
                <td>
                    <input id="text" type="text" name="titol" placeholder="Escriu el titul"/>
                </td>
            </tr>
            <tr> <!--Cos-->
                <td class="td_2">	
                    <label for="correu">Introdueix el cos del article:</label>		
                </td>
            </tr>
            <tr>
                <td>
                    <textarea type="text" name="cos" placeholder="Escriu el cos"></textarea>
                </td>
            </tr>
            <tr><!--Enviar dades-->
                <td>
                    <input id="enviar" type="submit" name="consultar" value="Consultar" />
                </td>
            </tr>
        </form>
        <tr><!--Anar endarrere-->
            <td>
                <form action="<?php echo htmlentities("../index.php"); ?>" method = "POST">
                    <input type="submit" name="endarrere" value="Endarrere">
                </form>
            </td>
        </tr>
    </table>
    <div id ="div"><!--Funció encarregada de cercar les dades indicades i retornar de manera gràfica aquestes-->
        <?php
                include_once "../Controlador/controlador.php";

                if(isset($_POST['consultar']))
                {
                    $t = $_POST['titol'];
                    $c = $_POST['cos'];
                    $result = buscar($t ?? "",$c ?? "");
                    $resTxt = "";
                    $hayContenido = false;
                    foreach ($result as $dada=>$valor){
                        $resTxt .= " <table id=\"TabCerc\">";
                        foreach ($valor as $dada2=>$valor2){
                            if($dada2 == "titol")
                            {
                                $resTxt .= "<tr id=\"DadCerc\"><td>".$dada2.":</td></tr><tr id=\"DadCerc\"><td>
                                <input id=\"text2\" type=\"text\" placeholder=\"Buit\" value=\"".$valor2."\" readonly/><td></tr>";                 
                                $hayContenido = true;
                            }
                            if($dada2 == "cos")
                            {
                                $resTxt .= "<tr id=\"DadCerc\"><td>".$dada2.":</td></tr><tr id=\"DadCerc\"><td>
                                <textarea id=\"textArea2\" placeholder=\"Buit\" readonly>".$valor2."</textarea></td></tr>";                 
                                $hayContenido = true;
                            }
                        }
                        $resTxt .= "</table>\n";
                    }
                    if($hayContenido)echo $resTxt;
                    else echo "<tr><td>No hi ha coincidencies</td></tr>";
                }
            ?>
    </div>
    
</body>
</html>