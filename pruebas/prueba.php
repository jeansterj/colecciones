<?php
require_once('./prueba2.php');
$hoteles = selectHoteles();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="estilos/estilo.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</head>

<body>
    <div class="container">
        <table class="table table-striped">
            <tr>
                <th>Cif</th>
                <th>Nombre</th>
                <th>Direccion Fiscal</th>
                
            </tr>
            <?php foreach ($hoteles as $hotel) { ?>
            <tr>
                <td><?php echo $hotel['cif']; ?></td>
                <td><?php echo $hotel['nombre']; ?></td>
                <td><?php echo $hotel['dir_fis']; ?></td>
               
            </tr>
            <?php } ?>
        </table>
    </div>
    <br>
    <H1>----------------------------------------------------------------------------------------------------------------------</H1>
    <div class="container">

    <?php require_once('mensajes.php'); 
    
      if(isset($_SESSION['cadena']))
        {

            $cadena = $_SESSION['cadena'];
            unset($_SESSION['cadena']);

        }
        else
        {

            $cadena = [


                'cif' => '',
                'nombre' => '',
                'dir_fis' => ''

            ];

       }
    
    ?>

        <form action="ciudadController.php" method="POST">

            <div class="form-group row">

                <label for="cif" class="col-sm-2 col-form-label">cif</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="cif" name="cif" placeholder="Identificador de la cadena"
                        autofocus
                        value="<?php echo $cadena['cif'] ?>">
                </div>

            </div>
            <br>
            <div class="form-group row">
                <label for="nombre" class="col-sm-2 col-form-label">Nombre</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre de la cadena"
                    value="<?php echo $cadena['nombre'] ?>">
                </div>

            </div>
            <br>
            <div class="form-group row">
                <label for="dir_fis" class="col-sm-2 col-form-label">Direccion Fiscal</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="dir_fis" name="dir_fis"
                        placeholder="Direccion Fiscal de la cadena"
                        value="<?php echo $cadena['dir_fis'] ?>">
                </div>

            </div>
            <br><br>


            <div class="float-right" >
                <div class="btn-group" role="group" aria-label="Basic example">
                    <button type="submit" class="btn btn-primary" name="insert">Aceptar</button>
                    <a href="index.php" class="btn btn-secondary">Cancelar</a>
                </div>

            </div>
            </form>
            <br><br>
            <H1>--------------------------------------------------------------------------------</H1>
            <form action="ciudadController.php" method="POST">

            <div class="form-group row">

                <label for="cif_delete" class="col-sm-2 col-form-label">cif</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="cif_delete" name="cif_delete" placeholder="Identificador de la cadena a eliminar"
                        autofocus
                        value="<?php echo $cadena['cif'] ?>">
                </div>

            </div>
         
            <div class="float-right" >
                <div class="btn-group" role="group" aria-label="Basic example">
                    <button type="submit" class="btn btn-primary" name="delete">Aceptar</button>
                    <a href="index.php" class="btn btn-secondary">Cancelar</a>
                </div>

            </div>
            <br><br>
            </form>

        
    </div>
</body>

</html>
