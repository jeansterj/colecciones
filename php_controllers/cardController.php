<?php

session_start();

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

    if (isset($_SESSION['error'])) 
    {
        header('Location: ../registroCard.php');
        exit();
    }
    } else
    
    {
        header('Location: ../index.php');
        exit();
    }

    

   

if (isset($_POST['updateNombre'])) {

    updateName(
        $_POST['idMounstro'],
        $_POST['newNombre']


    );
    header('Location: ../index.php');
    exit();
}

if (isset($_POST['updateDescripcion'])) {

    updateDescription(
        $_POST['idMounstro'],
        $_POST['newDescripcion']


    );
    header('Location: ../index.php');
    exit();
}

if (isset($_POST['updateNivel'])) {

    updateLevel(
        $_POST['idMounstro'],
        $_POST['newNivel']


    );
    header('Location: ../index.php');
    exit();
}

if (isset($_POST['updateAtk'])) {

    updateAtk(
        $_POST['idMounstro'],
        $_POST['newnAtaque']


    );
    header('Location: ../index.php');
    exit();
}

if (isset($_POST['updateDef'])) {

    updateDef(
        $_POST['idMounstro'],
        $_POST['newDefensa']


    );
    header('Location: ../index.php');
    exit();
}

if (isset($_POST['updateImg'])) {

    updateImg(
        $_POST['idMounstro'],
        $_POST['newImg']


    );
    header('Location: ../index.php');
    exit();
}

if (isset($_POST['updateAtribut'])) {

    updateAtribut(
        $_POST['idMounstro'],
        $_POST['newAtributo']


    );
    header('Location: ../index.php');
    exit();
}

if (isset($_POST['updateTipos'])) {
    $tipos_seleccionados = isset($_POST['newtipos']) ? $_POST['newtipos'] : [];


    updateTypes(
        $_POST['idMounstro'],
        $tipos_seleccionados

    );
    header('Location: ../index.php');
    exit();
}

if (isset($_POST['deleteCard'])) {


    deleteCard(
        $_POST['idMounstro'],

    );
    header('Location: ../index.php');
    exit();
}