<!DOCTYPE html>
<!--Xavi Rubio Monje-->
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link href="https://fonts.googleapis.com/css2?family=Open+Sans+Condensed:wght@300&display=swap" rel="stylesheet">  
	<link rel="stylesheet" href="../Estils/estils2.css"> <!-- feu referència al vostre fitxer d'estils -->
	<title>Paginació</title>
</head>
<body id="bodyConFoto">
	<?php include"../controlador/acabaSession.php";?>
	<?php include"../controlador/altres/icone.php";?>
	<div class="contenidor">
		<h1>Articles</h1>

		<div id ="div"><!--Resultat-->
        <?php
                include_once "../Controlador/controladorArtPag.php";
                    
					$cantidad;
					foreach (cantidad() as $dada=>$valor){ //aconseguir la quantitat de dades
						foreach ($valor as $dada2=>$valor2){
						if($dada2 == "COUNT(*)") $cantidad = $valor2;
						}
					}

					if(isset($_POST['artPag']))
					{
						if(($_POST['artPag']) > 1) $a = (int)($_POST['artPag']);//que los articulos por pagina no sean mas pequeños que 1
						else $a = 1;
						if($a > $cantidad) $a = $cantidad;
						$_POST['artPag'] = $a;
						$cantidad = round($cantidad/$a);
						if(($_POST['NumPag']) > 0) $n = (int)($_POST['NumPag']);//que la pagina no sean mas pequeña que 1
						else $n = 1;
					}else if(isset($_COOKIE['articles']))
					{
						$a = $_COOKIE['articles'];
						$n = $_COOKIE['pagina'];
						$_POST['artPag'] = $a;
						$_POST['NumPag'] = $n;

					}else
					{
						$a = 1;
						$n = 1;
					}
						
					

					do//si estas en una pàgina sin datos, te manda a la pàgina 1
					{
						$result = articles($n ?? "",$a ?? "");
						$resTxt = "";
						$hayContenido = false;
						foreach ($result as $dada=>$valor){//imprimir datos
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
						else //detecta si no hay datos en la pagina actual
						{
							$n = 1;
						}
					}while(!$hayContenido);
            ?>
    	</div>

        <form method="post" id="cambPag" action="<?php echo htmlentities($_SERVER["PHP_SELF"]);?>">
		<section class="paginacio">
			<ul>
				<?php
					$cantidad;
					foreach (cantidad() as $dada=>$valor){ //aconseguir la quantitat de dades
                        foreach ($valor as $dada2=>$valor2){
						if($dada2 == "COUNT(*)") $cantidad = $valor2;
						}
					}
					if(isset($_POST['artPag']))//aconseguir el numero de pàgines ($cantidad ara representa la cuantitat de pàgines)
					{
						if($_POST['artPag'] > 0)$cantidad = $cantidad/$_POST['artPag'];
					}
					if(isset($_POST["NumPag"]) && ($_POST['NumPag']) > 0 && ($_POST['NumPag']) < $cantidad+1)//guarda la pàgina actual (si és més petita que 0 va a la pàgina 1)
					{
						echo"<input type=\"hidden\" name=\"NumPag\" id=\"NumPag\" value=\"".$_POST['NumPag']."\">";
					}else
					{
						echo"<input type=\"hidden\" name=\"NumPag\" id=\"NumPag\" value=\"1\">";
						$_POST['NumPag'] = 1; 
					}
					//si esta en la página 1 no se muestre la flecha de atras
					if($_POST['NumPag'] > 1) echo"<li class=\"*disabled\"><a href=\"javascript:;\" onclick=\"document.getElementById('NumPag').value=(Number(document.getElementById('NumPag').value)-1);document.getElementById('cambPag').submit()\">&laquo;</a></li>"; 
					//Imprimir los numeros del pie de pagina
					for ($i = 0; $i < $cantidad; $i++)
					{
						if(($_POST['NumPag']) == ($i+1))
						{
							echo"<li class=\"active\"><a href=\"javascript:;\" onclick=\"document.getElementById('NumPag').value='".($i+1)."';document.getElementById('cambPag').submit()\">".($i+1)."</a></li>";
						}else
						{
							echo"<li><a href=\"javascript:;\" onclick=\"document.getElementById('NumPag').value='".($i+1)."';document.getElementById('cambPag').submit()\">".($i+1)."</a></li>";
						}
					}
					//si esta en la ultima página no se muestre la flecha de adelante
					if($_POST['NumPag'] < $cantidad) echo"<li class=\"*disabled\"><a href=\"javascript:;\" onclick=\"document.getElementById('NumPag').value=(Number(document.getElementById('NumPag').value)+1);document.getElementById('cambPag').submit()\">&raquo;</a></li>";
					//Si el número del article es 0 o menor es posa en 1
					echo"<br><br><b>Articles per pàgina:	<b>";
					if(isset($_POST["artPag"]) && ($_POST['artPag']) > 0)
					{
						echo"<input type=\"number\" name=\"artPag\" id=\"artPag\" pattern=\"[0-9]+\" onchange=\"document.getElementById('cambPag').submit()\" value=\"".$_POST['artPag']."\">";
					}else
					{
						echo"<input type=\"number\" name=\"artPag\" id=\"artPag\" pattern=\"[0-9]+\" onchange=\"document.getElementById('cambPag').submit()\" value=\"1\">";
						$_POST['artPag'] = 1; 
					}
					include("../controlador/cookies/cookiesPaginacio.php");
				?>
			</ul>
			
		</section>
		</form>
		<br>
		<tr>
            <td><!--Anar endarrere-->
                <form id="endarrere" action="<?php echo htmlentities("../index.php"); ?>" method = "POST">
					<?php include("../controlador/cookies/cookiesPaginacio.php"); ?>
					<a class="endarrere" href="javascript:;" onclick="<?php include("../controlador/cookies/cookiesPaginacio.php"); ?> document.getElementById('endarrere').submit()">Endarrere</a>
                </form>
            </td>
        </tr>
	</div>

</body>

</html>
