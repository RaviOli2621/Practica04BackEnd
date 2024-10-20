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
            <tr> <!--Titul Antic-->
                <td class="td_2">	
                    <label for="Intrnom">Introdueix el titul del article a editar:</label>		
                </td>
            </tr>
            <tr>
                <td>
                    <input id="text" type="text" name="titolOr" placeholder="Escriu el titul"/>
                </td>
            </tr>
            <tr> <!--Titul-->
                <td class="td_2">	
                    <label for="Intrnom">Introdueix el nou titul:</label>		
                </td>
            </tr>
            <tr>
                <td>
                    <input id="text" type="text" name="titol" placeholder="Escriu el titul"/>
                </td>
            </tr>
            <tr> <!--Cos-->
                <td class="td_2">	
                    <label for="correu">Introdueix el nou cos del article:</label>		
                </td>
            </tr>
            <tr>
                <td>
                    <textarea type="text" name="cos" placeholder="Escriu el cos"></textarea>
                </td>
            </tr>
            <tr>
                <td><!--Enviar dades-->
                    <input id="enviar" type="submit" name="editar" value="Editar" />
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
        <div class="resultado"><!--Funció encarregada de editar les dades indicades i retornar si s'ha pogut fer la acció-->
            
                    <?php
                        include_once "../Controlador/controladorArtEd.php";

                        if(isset($_POST['editar']))
                        {
                            $j = $_POST['titolOr'];
                            $t = $_POST['titol'];
                            $c = $_POST['cos'];
                            $result = modificar($j ?? "",$t ?? "",$c ?? "");

                            print_r($result);
                        }
                    ?>
                
            
        </div>
    </table>
</body>
</html>