<!DOCTYPE html>
<!--Xavi Rubio Monje-->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Estils/estilsLog.css"/>
    <title>Cercar</title>
</head>
<body>
    <div class="div">
        <table id="gen" class="table_2">
            <form method="post" action="<?php echo htmlentities($_SERVER["PHP_SELF"]);?>">
                <tr> <!--Nom-->
                    <td class="td_2">	
                        <label for="Intrnom">Introdueix el nom:</label>		
                    </td>
                </tr>
                <tr>
                    <td>
                        <input id="text" type="text" name="titol" placeholder="Escriu el teu nom"/>
                    </td>
                </tr>
                <tr> <!--Correu-->
                    <td class="td_2">	
                        <label for="Intrcorr">Introdueix el correu:</label>		
                    </td>
                </tr>
                <tr>
                    <td>
                        <input id="text" type="email" name="titol" placeholder="nom@gmail.com"/>
                    </td>
                </tr>
                <tr> <!--Contr-->
                    <td class="td_2">	
                        <label for="IntrContr">Introdueix la teva contrasenya:</label>		
                    </td>
                </tr>
                <tr>
                    <td>
                        <input id="text" type="password" name="contr" />
                    </td>
                </tr>
                <tr> <!--Contr-->
                    <td class="td_2">	
                        <label for="IntrContr">Torna a introdueix la teva contrasenya:</label>		
                    </td>
                </tr>
                <tr>
                    <td>
                        <input id="text" type="password" name="contr" />
                    </td>
                </tr>
                    <td><!--Enviar-->
                        <input id="inputSub" class="inputSub" type="submit" name="inserir" value="Enviar" />
                    </td>
                </tr>
            </form>
            <tr>
                <td><!--Anar endarrere-->
                    <form action="<?php echo htmlentities("../index.php"); ?>" method = "POST">
                        <input id="inputSub" class="inputSub" type="submit" name="endarrere" value="Endarrere">
                    </form>
                </td>
            </tr>
            <div class="resultado"><!--Funció encarregada de inserir les dades indicades i retornar si s'ha pogut fer la acció-->
                        <?php
                            include_once "../controlador/controlador.php";

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
    </div>
    
</body>
</html>