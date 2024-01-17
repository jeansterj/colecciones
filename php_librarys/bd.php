<?php

session_start();


function errorMensaje($e)

{

  if (!empty($e->errorInfo[1])) 
  {
  
    switch ($e->errorInfo[1]) 
    
    {
      case 1062:
        $mensaje = 'Registro duplicado';
        break;
      case 1451:
        $mensaje = 'Registro con elementos relacionados';  
        break;
        case 1366:
          $mensaje = 'Valor incorrecto';  
          break;
      default:
        $mensaje = $e->errorInfo[1] . ' - ' . $e->errorInfo[2];
        break;
    }
  
  }
  else
  {
    switch ($e->getCode()) 
    {
      case 1044:
        $mensaje = "Usuario y/o password incorrecto";
        break;
      case 1049: 
        $mensaje = "Usuario y/o password incorrecto";
        break;
        case 2002: 
          $mensaje = "No se encuentra el servidor";
          break;
      default:
      $mensaje = $e->getCode() . ' - ' . $e->getMensaje();
        break;
    }

  }

  return $mensaje;
  
}

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

function selectIdCard($id)

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

    WHERE mounstro.idMounstro = :id

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
  $sentencia->bindParam(':id', $id);
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

   try {

    $conexion = openBd();
    $conexion->beginTransaction();


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

 $conexion->commit();

 $_SESSION['mensaje'] = 'Registro insertado correctamente';

  } catch (PDOException $e) 
  
  {
    $conexion->rollback();

    $_SESSION['error'] = errorMensaje($e);
    $carta['nombre'] = $nombre;
    $carta['descripcion'] = $descripcion;
    $carta['ataque'] = $ataque;
    $carta['defensa'] = $defensa;
    $carta['atributo'] = $atributo;
    $carta['nivel'] = $nivel;
    $carta['tipos_seleccionados'] = $tipos_seleccionados;
    $_SESSION['carta'] = $carta;

  }

  $conexion = closeBd();
}

function insertTypes($tipos_seleccionados,$idMounstro,$conexion) {

    foreach ($tipos_seleccionados as $tipo) {
        $sentenciaTipo = "INSERT INTO mounstro_Tipo (idMounstro, idTipo) VALUES (:idMounstro, :idTipo)";
        $sentenciaTipo = $conexion->prepare($sentenciaTipo);
        $sentenciaTipo->bindParam(':idMounstro', $idMounstro);
        $sentenciaTipo->bindParam(':idTipo', $tipo);
        $sentenciaTipo->execute();
    }

}


function updateName($idMounstro,$nombre)
{

  try {
    $conexion = openBd();
    $conexion->beginTransaction();


    $sentenciaUpdate =
  
      "update mounstro 
      set nombre = :nombre
      where idMounstro = :idMounstro;";
  
    $sentencia = $conexion->prepare($sentenciaUpdate);
    $sentencia->bindParam(':idMounstro', $idMounstro);
    $sentencia->bindParam(':nombre', $nombre);
  
  
    $sentencia->execute();
    $conexion->commit();

    } catch (PDOException $e) {
      $conexion->rollback();

      $_SESSION['error'] = errorMensaje($e);
      $carta['nombre'] = $nombre;
      $_SESSION['carta'] = $carta;
    }

 
  $conexion = closeBd();
}

function updateDescription($idMounstro,$descripcion)
{
  try {

  $conexion = openBd();
  $conexion->beginTransaction();

  $sentenciaUpdate =

    "update mounstro 
    set descripcion = :descripcion
    where idMounstro = :idMounstro;";

  $sentencia = $conexion->prepare($sentenciaUpdate);
  $sentencia->bindParam(':idMounstro', $idMounstro);
  $sentencia->bindParam(':descripcion', $descripcion);


  $sentencia->execute();
  $conexion->commit();

} catch (PDOException $e) {
  $conexion->rollback();

  $_SESSION['error'] = errorMensaje($e);
  $carta['nombre'] = $descripcion;
  $_SESSION['carta'] = $carta;
}

  $conexion = closeBd();
}

function updateLevel($idMounstro,$nivel)
{
  try {

  $conexion = openBd();
  $conexion->beginTransaction();


  $sentenciaUpdate =

    "update mounstro 
    set nivel = :nivel
    where idMounstro = :idMounstro;";

  $sentencia = $conexion->prepare($sentenciaUpdate);
  $sentencia->bindParam(':idMounstro', $idMounstro);
  $sentencia->bindParam(':nivel', $nivel);


  $sentencia->execute();
  $conexion->commit();

} catch (PDOException $e) {
  $conexion->rollback();

  $_SESSION['error'] = errorMensaje($e);
  $carta['nombre'] = $nivel;
  $_SESSION['carta'] = $carta;
}
  $conexion = closeBd();
}

function updateAtk($idMounstro,$ataque)
{
  try {

  $conexion = openBd();
  $conexion->beginTransaction();

  $sentenciaUpdate =

    "update mounstro 
    set ataque = :ataque
    where idMounstro = :idMounstro;";

  $sentencia = $conexion->prepare($sentenciaUpdate);
  $sentencia->bindParam(':idMounstro', $idMounstro);
  $sentencia->bindParam(':ataque', $ataque);


  $sentencia->execute();
  $conexion->commit();


} catch (PDOException $e) {
  $conexion->rollback();

  $_SESSION['error'] = errorMensaje($e);
  $carta['nombre'] = $ataque;
  $_SESSION['carta'] = $carta;
}

  $conexion = closeBd();
}

function updateDef($idMounstro,$defensa)
{

  try {


  $conexion = openBd();
  $conexion->beginTransaction();

  $sentenciaUpdate =

    "update mounstro 
    set defensa = :defensa
    where idMounstro = :idMounstro;";

  $sentencia = $conexion->prepare($sentenciaUpdate);
  $sentencia->bindParam(':idMounstro', $idMounstro);
  $sentencia->bindParam(':defensa', $defensa);


  $sentencia->execute();
  $conexion->commit();

  
} catch (PDOException $e) {
  $conexion->rollback();
  $_SESSION['error'] = errorMensaje($e);
  $carta['nombre'] = $defensa;
  $_SESSION['carta'] = $carta;
}
  $conexion = closeBd();
}

function updateAtribut($idMounstro,$atributo)
{
  try {

  $conexion = openBd();
  $conexion->beginTransaction();


  $sentenciaUpdate =

    "update mounstro 
    set atributo = :atributo
    where idMounstro = :idMounstro;";

  $sentencia = $conexion->prepare($sentenciaUpdate);
  $sentencia->bindParam(':idMounstro', $idMounstro);
  $sentencia->bindParam(':atributo', $atributo);


  $sentencia->execute();
  $conexion->commit();

} catch (PDOException $e) {
  $conexion->rollback();
  $_SESSION['error'] = errorMensaje($e);
  $carta['nombre'] = $atributo;
  $_SESSION['carta'] = $carta;
}
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
  try {

  $conexion = openBd();
  $conexion->beginTransaction();

  $sentenciaUpdate =

    "update mounstro 
    set img = :img
    where idMounstro = :idMounstro;";

  $sentencia = $conexion->prepare($sentenciaUpdate);
  $sentencia->bindParam(':idMounstro', $idMounstro);
  $sentencia->bindParam(':img', $img);


  $sentencia->execute();
  $conexion->commit();


} catch (PDOException $e) {
  $conexion->rollback();
  $_SESSION['error'] = errorMensaje($e);
  $carta['nombre'] = $img;
  $_SESSION['carta'] = $carta;
}

  $conexion = closeBd();
}

function deleteCard($idMounstro) {
  try {

  $conexion = openBd();


  deleteTypes($conexion,$idMounstro);

  $sentenciaDelete =

  "delete from mounstro
  where idMounstro = :idMounstro;";

  $sentencia = $conexion->prepare($sentenciaDelete);
  $sentencia->bindParam(':idMounstro', $idMounstro);

  $sentencia->execute();


} catch (PDOException $e) {
  $_SESSION['error'] = errorMensaje($e);

}


  $conexion = closeBd();

}


function deleteTypes($conexion,$idMounstro) {

  try {
  $sentenciaDelete =

  "delete from  mounstro_Tipo
  where idMounstro = :idMounstro;";

  $sentencia = $conexion->prepare($sentenciaDelete);
  $sentencia->bindParam(':idMounstro', $idMounstro);

  $sentencia->execute();

} catch (PDOException $e) {

  $_SESSION['error'] = errorMensaje($e);

}

}
