<?php


require_once('../php_librarys/bd.php');


if($_SERVER["REQUEST_METHOD"] == "POST")

{

    if (isset($_POST['insert'])) {
        $tipos_seleccionados = isset($_POST['tipos']) ? $_POST['tipos'] : [];
        // Procesamiento de la imagen si se seleccionó
    if (isset($_FILES["img"]) && $_FILES["img"]["error"] == UPLOAD_ERR_OK) {
        $nombreArchivo = $_FILES["img"]["name"];
        $rutaTemporal = $_FILES["img"]["tmp_name"];
        $rutaDestino = "../img/mounstros/" . $nombreArchivo; // Ajusta la carpeta de destino según tu estructura
    
        
        $rutaBaseDatosIMG = "img/mounstros/" . $nombreArchivo;
    
        // Mueve el archivo temporal a la carpeta de destino
        move_uploaded_file($rutaTemporal, $rutaDestino);

        insertCard(
            $_POST['nombre'],
            $_POST['descripcion'],
            $_POST['ataque'],
            $_POST['defensa'],
            $_POST['atributo'],
            $_POST['nivel'],
            $rutaBaseDatosIMG,
            $tipos_seleccionados
        );
    
        if (isset($_SESSION['error'])) 
        {
            header('Location: ../registroCard.php');
            exit();
        }
         else
        
        { 
            header('Location: ../index.php');
            exit();
       } 
    } else {


        $_SESSION['error'] = "Error: no se selecciono una imagen.";
        header('Location: ../registroCard.php');
        exit();
    }
          
    } 


}

   

if (isset($_POST['updateNombre'])) {

    updateName(
        $_POST['idMounstro'],
        $_POST['newNombre']


    );
    if (isset($_SESSION['error'])) 
    {
        header('Location: ../registroCard.php');
        exit();
    }
     else
    
    { 
        header('Location: ../index.php');
        exit();
   } 
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
    if (isset($_FILES["newImg"]) && $_FILES["newImg"]["error"] == UPLOAD_ERR_OK) {
        $nombreArchivo = $_FILES["newImg"]["name"];
        $rutaTemporal = $_FILES["newImg"]["tmp_name"];
        $rutaDestino = "../img/mounstros/" . $nombreArchivo;
        $rutaBaseDatosIMG = "img/mounstros/" . $nombreArchivo;

        // Mueve el archivo temporal a la carpeta de destino
        if (move_uploaded_file($rutaTemporal, $rutaDestino)) {
            // Actualiza la imagen en la base de datos
            updateImg($_POST['idMounstro'], $rutaBaseDatosIMG);
        } else {
            echo "Error al mover el archivo";
        }
    }
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
    $tipos_seleccionados = isset($_POST['newTipos']) ? $_POST['newTipos'] : [];

    updateTypes(
        $_POST['idMounstro'],
        $tipos_seleccionados
    );

    header('Location: ../index.php');
    exit();
}


if (isset($_POST['deleteCard'])) {

    $rutaImagen = selectRutaImagen($_POST['idMounstro']);
    $rutaCompleta = "../" . $rutaImagen['img'];

   
    unlink($rutaCompleta);


    deleteCard(
        $_POST['idMounstro'],

    );


    header('Location: ../index.php');
    exit();
}

