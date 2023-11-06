<?php

require_once('prueba2.php');

if (isset($_POST['insert'])) {
    

    insertCadenas($_POST['cif'],$_POST['nombre'],$_POST['dir_fis']);




    
    header('Location: index.php');
    exit();

} elseif (isset($_POST['delete']))

{

    deleteCadenas($_POST['cif_delete']);
    header('Location: index.php');

    exit();
}



?>