<?php
//Xavi Rubio Monje
if(isset($_SESSION['Usuari']) && !isset($_POST['LogOut']))
{
    echo '<div id="circle">
        <div>
            <h1>'.substr($_SESSION['Usuari'],0,1).'</h1>
        </div>
    </div>';
}
?>