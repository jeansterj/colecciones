<?php

session_start();

function errorMensaje($e)
{

if(!empty($e->errorInfo[1]))
{

switch ($e->errorInfo[1])

{
    case 1062:
        $mensaje = 'Registro duplicado';
        break;
        case 1451:
            $mensaje = 'Registro con elementos relacionados';
            break;
    
    default:
    $mensaje = $e->errorInfo[1] . ' - ' . $e->errorInfo[2];
        break;
}

}
else 
{

switch ($e->getCode()) {
    case 1044:
        $mensaje = 'Usuario y/o password incorrecto';
        break;
        case 1049:
            $mensaje = 'Base de datos desconocida';
            break;
            case 2002:
                $mensaje = 'No se encuentra el servidor';
                break;
            
    default:
    $mensaje = $e->getCode() . ' - ' . $e->getMessage();
        break;
}


}


return $mensaje;

}


function openBd()

{

$servername = "localhost";
$username  = "root";
$password = "mysql";

 $conexion = new PDO("mysql:host=$servername;dbname=hoteles_dwes", $username, $password);
 $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$conexion->exec("set names utf8");

return $conexion;
}

?>

<?php

function closeBd()

{
return null;

}

function selectHoteles()
{

$conexion = openBd();

 
$sentenciaText = "select * from cadenas";
$sentencia = $conexion->prepare($sentenciaText);
$sentencia->execute();

$resultado = $sentencia->fetchAll();

$conexion = closeBd();

return $resultado;

}


function insertCadenas($cif,$nombre,$dir_fis){

    try {

        $conexion = openBd();

        $sentenciaText = "insert into cadenas (cif,nombre,dir_fis) values (:cif, :nombre, :dir_fis)";
        $sentencia = $conexion->prepare($sentenciaText);
        $sentencia->bindParam(':cif', $cif);
        $sentencia->bindParam(':nombre', $nombre);
        $sentencia->bindParam(':dir_fis', $dir_fis);
    
        $sentencia->execute();
    
    
    
        
        $_SESSION['mensaje'] = 'Registro insertado correctamente';




    } catch (PDOException $e) {


$_SESSION['error'] = errorMensaje($e);
$cadena['cif'] = $cif;
$cadena['nombre'] = $nombre;
$cadena['dir_fis'] = $dir_fis;

$_SESSION['cadena'] = $cadena;


    }
    $conexion = closeBd();
    
}

function deleteCadenas($cif)
{

    try {
        $conexion = openBd();
        $sentenciaText = "delete from cadenas where (cif= :cif)";
        $sentencia = $conexion->prepare($sentenciaText);
        $sentencia->bindParam(':cif', $cif);
    
    
     $resultado=$sentencia->execute();

     $_SESSION['mensaje'] = 'Registro borrado correctamente';

     
    
    } catch (PDOException $e) {
        $_SESSION['error'] = errorMensaje($e);
        $cadena['cif'] = $cif;
            }





}
$conexion = closeBd();

?>

