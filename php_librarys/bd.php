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

function selectUniqueCard($nombre)

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

    WHERE mounstro.nombre = :nombre

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
  $sentencia->bindParam(':nombre', $nombre);
  $sentencia->execute();

  $resultado = $sentencia->fetchAll();



  $conexion = closeBd();

  return $resultado;
}

function selectTypes()

{

  $conexion = openBd();


  $sentenciaSelect =

    "select * from tipo;";

  $sentencia = $conexion->prepare($sentenciaSelect);
  $sentencia->execute();

  $resultado = $sentencia->fetchAll();


  $conexion = closeBd();

  return $resultado;
}

function selectAtribut()

{

  $conexion = openBd();


  $sentenciaSelect =

    "select * from atributo;";

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

 insertTypes($tipos_seleccionados,$idMounstro,$conexion);


  $conexion = closeBd();
}

function insertTypes($tipos_seleccionados,$idMounstro,$conexion) {
  foreach ($tipos_seleccionados as $tipo) {
    $sentenciaTipo  = "insert into mounstro_Tipo (idMounstro, idTipo) values (:idMounstro, :idTipo)";
    $sentenciaTipo  = $conexion->prepare($sentenciaTipo);
    $sentenciaTipo->bindParam(':idMounstro', $idMounstro);
    $sentenciaTipo->bindParam(':idTipo', $tipo);
    $sentenciaTipo->execute();
  }
}

function updateName($idMounstro,$nombre)
{

  $conexion = openBd();

  $sentenciaUpdate =

    "update mounstro 
    set nombre = :nombre
    where idMounstro = :idMounstro;";

  $sentencia = $conexion->prepare($sentenciaUpdate);
  $sentencia->bindParam(':idMounstro', $idMounstro);
  $sentencia->bindParam(':nombre', $nombre);


  $sentencia->execute();
  $conexion = closeBd();
}

function updateDescription($idMounstro,$descripcion)
{

  $conexion = openBd();

  $sentenciaUpdate =

    "update mounstro 
    set descripcion = :descripcion
    where idMounstro = :idMounstro;";

  $sentencia = $conexion->prepare($sentenciaUpdate);
  $sentencia->bindParam(':idMounstro', $idMounstro);
  $sentencia->bindParam(':descripcion', $descripcion);


  $sentencia->execute();

  $conexion = closeBd();
}

function updateLevel($idMounstro,$nivel)
{

  $conexion = openBd();

  $sentenciaUpdate =

    "update mounstro 
    set nivel = :nivel
    where idMounstro = :idMounstro;";

  $sentencia = $conexion->prepare($sentenciaUpdate);
  $sentencia->bindParam(':idMounstro', $idMounstro);
  $sentencia->bindParam(':nivel', $nivel);


  $sentencia->execute();

  $conexion = closeBd();
}

function updateAtk($idMounstro,$ataque)
{

  $conexion = openBd();

  $sentenciaUpdate =

    "update mounstro 
    set ataque = :ataque
    where idMounstro = :idMounstro;";

  $sentencia = $conexion->prepare($sentenciaUpdate);
  $sentencia->bindParam(':idMounstro', $idMounstro);
  $sentencia->bindParam(':ataque', $ataque);


  $sentencia->execute();

  $conexion = closeBd();
}

function updateDef($idMounstro,$defensa)
{

  $conexion = openBd();

  $sentenciaUpdate =

    "update mounstro 
    set defensa = :defensa
    where idMounstro = :idMounstro;";

  $sentencia = $conexion->prepare($sentenciaUpdate);
  $sentencia->bindParam(':idMounstro', $idMounstro);
  $sentencia->bindParam(':defensa', $defensa);


  $sentencia->execute();

  $conexion = closeBd();
}

function updateAtribut($idMounstro,$atributo)
{

  $conexion = openBd();

  $sentenciaUpdate =

    "update mounstro 
    set atributo = :atributo
    where idMounstro = :idMounstro;";

  $sentencia = $conexion->prepare($sentenciaUpdate);
  $sentencia->bindParam(':idMounstro', $idMounstro);
  $sentencia->bindParam(':atributo', $atributo);


  $sentencia->execute();

  $conexion = closeBd();
}

function updateTypes($idMounstro,$tipos_seleccionados)
{

  $conexion = openBd();

    deleteTypes($conexion,$idMounstro);

    insertTypes($tipos_seleccionados,$idMounstro,$conexion);


  $conexion = closeBd();
}

function updateImg($idMounstro,$img)
{

  $conexion = openBd();

  $sentenciaUpdate =

    "update mounstro 
    set img = :img
    where idMounstro = :idMounstro;";

  $sentencia = $conexion->prepare($sentenciaUpdate);
  $sentencia->bindParam(':idMounstro', $idMounstro);
  $sentencia->bindParam(':img', $img);


  $sentencia->execute();

  $conexion = closeBd();
}

function deleteCard($idMounstro) {

  $conexion = openBd();

  deleteTypes($conexion,$idMounstro);

  $sentenciaDelete =

  "delete from mounstro
  where idMounstro = :idMounstro;";

  $sentencia = $conexion->prepare($sentenciaDelete);
  $sentencia->bindParam(':idMounstro', $idMounstro);

  $sentencia->execute();

  $conexion = closeBd();

}


function deleteTypes($conexion,$idMounstro) {


  $sentenciaDelete =

  "delete from  mounstro_Tipo
  where idMounstro = :idMounstro;";

  $sentencia = $conexion->prepare($sentenciaDelete);
  $sentencia->bindParam(':idMounstro', $idMounstro);

  $sentencia->execute();


}
