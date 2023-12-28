<?php

require_once('../php_librarys/bd.php');

if (isset($_POST['insert'])) {
    $tipos_seleccionados = isset($_POST['tipos']) ? $_POST['tipos'] : [];
    
    insertCard(
        $_POST['nombre'],
        $_POST['descripcion'],
        $_POST['ataque'],
        $_POST['defensa'],
        $_POST['atributo'],
        $_POST['nivel'],
        $_POST['img'],
        $tipos_seleccionados
    );

    header('Location: ../index.php');
    exit();
}
?>


