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
    <?php include"../controlador/acabaSession.php"; salirSinUser()?>
    <?php include"../controlador/altres/icone.php";?>
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
            <tr>
                <td><!--Enviar-->
                    <input id="enviar" class="enviar" type="submit" name="inserir" value="Inserir" />
                </td>
            </tr>
        </form>
        <tr>
            <td><!--Anar endarrere-->
                <form action="<?php echo htmlentities("../index.php"); ?>" method = "POST">
                    <input type="submit" name="endarrere" value="Endarrere">
                </form>
            </td>
        </tr>
        <div class="resultado"><!--Funció encarregada de inserir les dades indicades i retornar si s'ha pogut fer la acció-->
                    <?php
                        include_once "../Controlador/controladorArtIns.php";

                        if(isset($_POST['inserir']))
                        {
                            $t = $_POST['titol'];
                            $c = $_POST['cos'];
                            if(strlen(preg_replace("/\s+/","",$t)) < 1)
                            {
                                print_r("<tr><td id=\"ResM\">El titol no pot ser ni buit ni només espais</td></tr>");
                            }else
                            {
                                $result = inserir($t ?? "",$c ?? "");
                                $resTxt = "";
                                $hayContenido = false;
                                print_r($result);    
                            }
                        }
                    ?>
        </div>
    </table>
</body>
</html>