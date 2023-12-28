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
    GROUP_CONCAT(tipo.nombreTipo SEPARATOR '/') AS Tipos,
    atributo.nombreAtributo AS Atributo,
    mounstro.nivel,
    mounstro.img

    from mounstro
    
    JOIN 
    mounstro_Tipo ON mounstro.idMounstro = mounstro_Tipo.idMounstro
    JOIN 
    tipo ON tipo.idTipo = mounstro_Tipo.idTipo
    JOIN 
    atributo ON mounstro.atributo = atributo.idAtributo
    GROUP BY 
    mounstro.nombre, 
    mounstro.descripcion,
    mounstro.ataque,
    mounstro.defensa,
    atributo.nombreAtributo,
    mounstro.nivel,
    mounstro.img;
    ";

    
    $sentencia = $conexion->prepare($sentenciaSelect);
    $sentencia->execute();

    $resultado = $sentencia->fetchAll();



    $conexion = closeBd();

    return $resultado;

}

function insertCard($nombre,$descripcion,$ataque,$defensa,$atributo,$nivel,$img) 

{

  $conexion = openBd();

  $sentenciaSelect =" insert into mounstro (nombre,descripcion,ataque,defensa,atributo,nivel,img)
  values (:nombre,:descripcion,:ataque,:defensa,:atributo,:nivel,:img) 
  ;";

  
  $sentencia = $conexion->prepare($sentenciaSelect);
  $sentencia->bindParam(':nombre', $nombre);
  $sentencia->bindParam(':descripcion', $descripcion);
  $sentencia->bindParam(':ataque', $ataque);
  $sentencia->bindParam(':defensa', $defensa);
  $sentencia->bindParam(':atributo', $atributo);
  $sentencia->bindParam(':nivel', $nievl);
  $sentencia->bindParam(':img', $img);


  $sentencia->execute();

  $conexion = closeBd();

}

?>
