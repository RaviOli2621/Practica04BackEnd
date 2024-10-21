<!DOCTYPE html>
<!--Xavi Rubio Monje-->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Estils/estilsLog.css"/>
    <script defer src="Js/mantenerDatos.js"></script>;
    <title>Cercar</title>
</head>
<body>
    <div class="div">
        <table id="gen" class="table_2">
            <form method="post" action="<?php echo htmlentities($_SERVER["PHP_SELF"]);?>">
                <tr> <!--Nom-->
                    <td class="td_2">	
                        <label for="Intrnom">Introdueix el usuari:</label>		
                    </td>
                </tr>
                <tr>
                    <td>
                        <input id="usuari" type="text" name="usuari" placeholder="Escriu el teu usuari"/>
                    </td>
                </tr>
                <tr> <!--Correu-->
                    <td class="td_2">	
                        <label for="Intrcorr">Introdueix el correu:</label>		
                    </td>
                </tr>
                <tr>
                    <td>
                        <input id="correu" type="text" name="correu" placeholder="nom@gmail.com"/>
                    </td>
                </tr>
                <tr> <!--Contr-->
                    <td class="td_2">	
                        <label for="IntrContr">Introdueix la teva contrasenya:</label>		
                    </td>
                </tr>
                <tr>
                    <td>
                        <input id="contr" type="password" name="contr" />
                    </td>
                </tr>
                <tr> <!--Contr-->
                    <td class="td_2">	
                        <label for="IntrContr">Torna a introdueix la teva contrasenya:</label>		
                    </td>
                </tr>
                <tr>
                    <td>
                        <input id="contr2" type="password" name="contr2" />
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
                            include_once "../controlador/controladorSign.php";
                            
                            if(isset($_POST['inserir']))
                            {
                                $u = $_POST['usuari'];
                                $c = $_POST['correu'];
                                $p = $_POST['contr'];
                                $p2 = $_POST['contr2'];

        
                                $result = inserir($c ?? "",$u ?? "",$p ?? "",$p2 ?? "");
                                print_r($result);       
                                echo'<input id="resposta" type="hidden" name="resposta" value="'.$u.','.$c.'"/>';
                            }else
                            {
                                echo'<input id="resposta" type="hidden" name="resposta" value="noHay"/>';
                            }
                        ?>
            </div>
        </table>
    </div>
    
</body>
</html>