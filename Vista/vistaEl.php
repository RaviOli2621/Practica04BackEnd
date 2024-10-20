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
    <?php include"../controlador/acabaSession.php";?>
    <?php include"../controlador/altres/icone.php";?>
    <table id="gen" class="table_2">
        <form method="post" action="<?php echo htmlentities($_SERVER["PHP_SELF"]);?>">
            <?php //Misatge de confirmació
                if(isset($_POST['eliminarSeguridad']))
                {
                    echo "<h1>Segur que vols eliminar aquest article?</h1>";
                }
            ?>
            <tr> <!--Titul-->
                <td class="td_2">	
                    <label for="Intrnom">Introdueix el titul del article a eliminar:</label>		
                </td>
            </tr>
            <tr>
                <td><!--En la confirmació es conservara la resposta antiga-->
                    <?php
                        if(isset($_POST['eliminarSeguridad']))
                        {
                            echo "<input readonly id=\"text\" type=\"text\" name=\"titol\" placeholder=\"Escriu el titul\" value =\"".$_POST['titol']."\"/>";

                        }else
                        {
                            echo "<input id=\"text\" type=\"text\" name=\"titol\" placeholder=\"Escriu el titul\"/>";
                        }
                    ?>
                </td>
            </tr>
            <tr><!--El boto amb el nom eliminarSeguridad serveix per poder fer la segona confirmació de eliminacio de dades-->
                <td>
                    <?php
                        if(isset($_POST['eliminarSeguridad']))
                        {
                            echo "<input id=\"enviar\" type=\"submit\" name=\"eliminar\" value=\"Eliminar\" />";
                        }else
                        {
                            echo "<input id=\"enviar\" type=\"submit\" name=\"eliminarSeguridad\" value=\"Eliminar\" />";
                        }
                    ?>
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
        <div class="resultado"><!--Funció encarregada de elimiar les dades indicades i retornar si s'ha pogut fer la acció-->
                    <?php
                        include_once "../Controlador/controladorArtEl.php";

                        if(isset($_POST['eliminar']))
                        {
                            $t = $_POST['titol'];
                            $result = eliminar($t ?? "");
                            $resTxt = "";
                            $hayContenido = false;
                            print_r($result);
                        }
                    ?>
        </div>
    </table>
</body>
</html>