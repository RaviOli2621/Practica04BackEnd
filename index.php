<!DOCTYPE html>
<!--Xavi Rubio Monje-->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Estils/estils.css"/>
    <title>Index</title>
</head>
<body> <!--Botons per anar a les diferents vistes-->
    <form action="<?php echo htmlentities("Vista/vistaIns.php"); ?>" method = "POST">
        <input class="button" type="submit" name="AnInserir" value="Inserir">
    </form>
    <form action="<?php echo htmlentities("Vista/vistaCer.php"); ?>" method = "POST">
        <input class="button" type="submit" name="AnCercar" value="Cercar">
    </form>
    <form action="<?php echo htmlentities("Vista/vistaEd.php"); ?>" method = "POST">
        <input class="button" type="submit" name="AnEditar" value="Editar">
    </form>
    <form action="<?php echo htmlentities("Vista/vistaEl.php"); ?>" method = "POST">
        <input class="button" type="submit" name="AnEliminar" value="Eliminar">
    </form>
    <form action="<?php echo htmlentities("Vista/vistaPag.php"); ?>" method = "POST">
        <input class="button" type="submit" name="AnEliminar" value="Eliminar">
    </form>
</body>
</html>