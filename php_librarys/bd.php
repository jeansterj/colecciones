<?php

function openBd()

{
    
    $servername = "localhost";
    $username = "root";
    $password = "mysql";
    
    try {
      $conn = new PDO("mysql:host=$servername;dbname=coleccions", $username, $password);
      // set the PDO error mode to exception
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $conn->exec("set names utf8");
    } catch(PDOException $e) {
      echo "Connection failed: " . $e->getMessage();
    }

    return $conn;

}

function closeBd()

{
return null;    
}

function selectCard() 

{

    $conexion = openBd();
    
    
    $sentenciaSelect =
    
    
    "select 

    mounstro.nombre, 
    mounstro.descripcion,
    mounstro.ataque,
    mounstro.defensa,
    tipo.nombreTipo AS Tipo,
    atributo.nombreAtributo AS Atributo,
    mounstro.nivel

    from mounstro
    
    JOIN 
    mounstro_Tipo ON mounstro.idMounstro = mounstro_Tipo.idMounstro
    JOIN 
    tipo ON tipo.idTipo = mounstro_Tipo.idTipo
    JOIN 
    atributo ON mounstro.atributo = atributo.idAtributo;";

    
    $sentencia = $conexion->prepare($sentenciaSelect);
    $sentencia->execute();

    $resultado = $sentencia->fetchAll();



    $conexion = closeBd();

    return $resultado;

}

?>
