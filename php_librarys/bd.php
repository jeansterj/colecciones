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
  } catch (PDOException $e) {
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

    mounstro.idMounstro,
    mounstro.nombre, 
    mounstro.descripcion,
    mounstro.ataque,
    mounstro.defensa,
    GROUP_CONCAT(tipo.nombreTipo SEPARATOR '/') AS Tipos,
    atributo.nombreAtributo AS Atributo,
    mounstro.nivel,
    mounstro.img

    from mounstro
    
    LEFT JOIN 
    mounstro_Tipo ON mounstro.idMounstro = mounstro_Tipo.idMounstro
    LEFT JOIN 
    tipo ON tipo.idTipo = mounstro_Tipo.idTipo
    LEFT JOIN 
    atributo ON mounstro.atributo = atributo.idAtributo
    GROUP BY 
    mounstro.idMounstro,
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

function insertCard($nombre, $descripcion, $ataque, $defensa, $atributo, $nivel, $img, $tipos_seleccionados)

{

  $conexion = openBd();


  $sentenciaInsert = " insert into mounstro (nombre,descripcion,ataque,defensa,atributo,nivel,img)
  values (:nombre,:descripcion,:ataque,:defensa,:atributo,:nivel,:img) 
  ;";

  $sentencia = $conexion->prepare($sentenciaInsert);
  $sentencia->bindParam(':nombre', $nombre);
  $sentencia->bindParam(':descripcion', $descripcion);
  $sentencia->bindParam(':ataque', $ataque);
  $sentencia->bindParam(':defensa', $defensa);
  $sentencia->bindParam(':atributo', $atributo);
  $sentencia->bindParam(':nivel', $nivel);
  $sentencia->bindParam(':img', $img);


  $sentencia->execute();

  $idMounstro = $conexion->lastInsertId();

  foreach ($tipos_seleccionados as $tipo) {
    $sentenciaTipo  = "insert into mounstro_Tipo (idMounstro, idTipo) values (:idMounstro, :idTipo)";
    $sentenciaTipo  = $conexion->prepare($sentenciaTipo);
    $sentenciaTipo->bindParam(':idMounstro', $idMounstro);
    $sentenciaTipo->bindParam(':idTipo', $tipo);
    $sentenciaTipo->execute();
  }



  $conexion = closeBd();
}
