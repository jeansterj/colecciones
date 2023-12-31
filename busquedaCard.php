<?php

require_once('./php_librarys/bd.php');

$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';


$tipos = selectTypes();
$atributos = selectAtribut();
$cartas = selectUniqueCard($nombre);
?>


<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
  </script>
  <link rel="stylesheet" href="./style/estilos.css">


</head>

<header>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="./index.php">
        <img src="img/Logo_Yugioh.png" alt="Logo_Yugioh" style="width: 180px; height: 50px;" class="mr-2">
      </a>


      <a class="btn btn-outline-info" role="button" aria-pressed="true" href="./registroCard.php">Crear Carta</a>
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
      </ul>
    </div>
    </div>
  </nav>
</header>

<body>



  <div class="container-fluid">
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-3 g-4">

      <?php
      foreach ($cartas as $carta) { ?>
        <div class="col">

          <div class="card clickable-card ajudteBody ">
            <div class="card bg-dark plantilla">
              <div class="card-body cardUni">
                <div class="cardFirtPart">

                  <button class="btn btn-lg btn-outline-light " style="color: black;" id="nombre<?php echo $carta['idMounstro'] ?>" disabled data-bs-toggle="modal" data-bs-target="#modalnombre<?= $carta['idMounstro'] ?>">
                    <?php echo  $carta['nombre'] ?></button>

                  <button class="btn btn-lg btn-outline-light cardAtribute " style="color: black;" id="atributo<?php echo $carta['idMounstro'] ?>" disabled data-bs-toggle="modal" data-bs-target="#modalAtributo<?= $carta['idMounstro'] ?>">
                    <img src="./img/<?php echo $carta['Atributo'] ?>.png" alt="<?php $carta['Atributo'] ?>"></button>

                </div>
                <div class="botonesModifi">

                  <button class="btn btn-success modDanger" id="habilitar<?php echo $carta['idMounstro'] ?>" onclick="habilitarBotones(<?php echo $carta['idMounstro'] ?>)"><img class="ajusteImg" src="./img/modif.png" alt="modificar"></button>
                  <button class="btn btn-sucess modDanger" style="display: none;" id="deshabilitar<?php echo $carta['idMounstro'] ?>" onclick="deshabilitarBotones(<?php echo $carta['idMounstro'] ?>)"><img class="ajusteImg" src="./img/completado.png" alt="modificar"></button>
                  <button class="btn btn-danger modDanger" id="borrar<?php echo $carta['idMounstro'] ?>" data-bs-toggle="modal" data-bs-target="#modalConfirDelete<?= $carta['idMounstro'] ?>"><img class="ajusteImg" src="./img/eliminar.png" alt="eliminarr"></button>

                </div>
                <div class="cardLevel">
                  <button class="btn btn-lg btn-outline-light " style="color: black;" id="nivel<?php echo $carta['idMounstro'] ?>" disabled data-bs-toggle="modal" data-bs-target="#modalNivel<?= $carta['idMounstro'] ?>">
                    <?php echo "Nivel " . $carta['nivel'] ?></button>

                </div>

                <div><button disabled class="cardButImg" id="img<?php echo $carta['idMounstro'] ?>">
                    <img src="./img/<?php echo $carta['img'] ?>" class="cardImg" alt="<?php echo  $carta['nombre'] ?>" disabled data-bs-toggle="modal" data-bs-target="#modalimg<?= $carta['idMounstro'] ?>">></button></div>

                <button class="btn btn-lg btn-outline-light cardType" style="color: black;" id="tipo<?php echo $carta['idMounstro'] ?>" disabled data-bs-toggle="modal" data-bs-target="#modalTipos<?= $carta['idMounstro'] ?>">
                  <strong> <?php echo "[" . $carta['Tipos'] . "]" ?></strong></button>

                <button class="btn btn-lg btn-outline-light cardDescription" style="color: black;" id="descripcion<?php echo $carta['idMounstro'] ?>" disabled data-bs-toggle="modal" data-bs-target="#modalDescripcion<?= $carta['idMounstro'] ?>">
                  <?php echo $carta['descripcion'] ?></button>

                <div class="cardPuntationContainer">
                  <div class="cardPuntation">
                    <button class="btn btn-lg btn-outline-light textPuntation" style="color: black;" id="atkBut<?php echo $carta['idMounstro'] ?>" disabled data-bs-toggle="modal" data-bs-target="#modalAtaque<?= $carta['idMounstro'] ?>">
                      <b><?php echo $carta['ataque'] ?></button></b>

                    <button class="btn btn-lg btn-outline-light textPuntation space" style="color: black;" id="defBut<?php echo $carta['idMounstro'] ?>" disabled data-bs-toggle="modal" data-bs-target="#modalDefensa<?= $carta['idMounstro'] ?>">
                      <b><?php echo $carta['defensa'] ?></button></b>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>
      <?php } ?>
    </div>
  </div>

  <?php
  foreach ($cartas as $carta) { ?>

    <div class="modal fade" id="modalConfirDelete<?= $carta['idMounstro'] ?>" tabindex="-1" aria-labelledby="modalConfirDelete" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel2">Seguro de eliminar la siguiente carta :
              <?= $carta['nombre'] ?>
            </h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">

            <form action="./php_controllers/cardController.php" method="POST" enctype="multipart/form-data">

              <input type="hidden" name="idMounstro" value="<?= $carta['idMounstro'] ?>">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>

              <button type="submit" class="btn btn-danger" name="deleteCard">Eliminar Carta</button>
            </form>

            </form>




          </div>

        </div>
      </div>
    </div>




    <div class="modal fade" id="modalnombre<?= $carta['idMounstro'] ?>" tabindex="-1" aria-labelledby="modalnombre<?= $carta['idMounstro'] ?>" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel2">Actual :
              <?= $carta['nombre'] ?>
            </h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">

            <form action="./php_controllers/cardController.php" method="POST" enctype="multipart/form-data">

              <input type="hidden" name="idMounstro" value="<?= $carta['idMounstro'] ?>">
              <input autofocus class="form-control mb-3" type="text" name="newNombre">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
              <button type="submit" class="btn btn-success" name="updateNombre">Confirmar
                modificacion</button>
            </form>




          </div>

        </div>
      </div>
    </div>

    <div class="modal fade" id="modalDescripcion<?= $carta['idMounstro'] ?>" tabindex="-1" aria-labelledby="modalDescripcion<?= $carta['idMounstro'] ?>" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel2">Actual :
              <?= $carta['descripcion'] ?>
            </h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">

            <form action="./php_controllers/cardController.php" method="POST" enctype="multipart/form-data">

              <input type="hidden" name="idMounstro" value="<?= $carta['idMounstro'] ?>">
              <input autofocus class="form-control mb-3" type="text" name="newDescripcion">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
              <button type="submit" class="btn btn-success" name="updateDescripcion">Confirmar
                modificacion</button>
            </form>




          </div>

        </div>
      </div>
    </div>

    <div class="modal fade" id="modalNivel<?= $carta['idMounstro'] ?>" tabindex="-1" aria-labelledby="modalNivel<?= $carta['idMounstro'] ?>" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel2">Actual :
              <?= $carta['nivel'] ?>
            </h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">

            <form action="./php_controllers/cardController.php" method="POST" enctype="multipart/form-data">

              <input type="hidden" name="idMounstro" value="<?= $carta['idMounstro'] ?>">

              <input autofocus class="form-control mb-3" name="newNivel" type="number" min="0" max="12" required>
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
              <button type="submit" class="btn btn-success" name="updateNivel">Confirmar
                modificacion</button>
            </form>

          </div>

        </div>
      </div>
    </div>

    <div class="modal fade" id="modalAtaque<?= $carta['idMounstro'] ?>" tabindex="-1" aria-labelledby="modalAtaque<?= $carta['idMounstro'] ?>" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel2">Actual :
              <?= $carta['ataque'] ?>
            </h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">

            <form action="./php_controllers/cardController.php" method="POST" enctype="multipart/form-data">

              <input type="hidden" name="idMounstro" value="<?= $carta['idMounstro'] ?>">
              <input autofocus class="form-control mb-3" name="newnAtaque" type="number" min="0" max="9999" required>
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
              <button type="submit" class="btn btn-success" name="updateAtk">Confirmar
                modificacion</button>
            </form>




          </div>

        </div>
      </div>
    </div>

    <div class="modal fade" id="modalDefensa<?= $carta['idMounstro'] ?>" tabindex="-1" aria-labelledby="modalDefensa<?= $carta['idMounstro'] ?>" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel2">Actual :
              <?= $carta['defensa'] ?>
            </h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">

            <form action="./php_controllers/cardController.php" method="POST" enctype="multipart/form-data">

              <input type="hidden" name="idMounstro" value="<?= $carta['idMounstro'] ?>">
              <input autofocus class="form-control mb-3" name="newDefensa" type="number" min="0" max="9999" required>
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
              <button type="submit" class="btn btn-success" name="updateDef">Confirmar
                modificacion</button>
            </form>




          </div>

        </div>
      </div>
    </div>

    <div class="modal fade" id="modalTipos<?= $carta['idMounstro'] ?>" tabindex="-1" aria-labelledby="modalTipos<?= $carta['idMounstro'] ?>" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel2">Actual :
              <?= $carta['Tipos'] ?>
            </h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">

            <form action="./php_controllers/cardController.php" method="POST" enctype="multipart/form-data">

              <input type="hidden" name="idMounstro" value="<?= $carta['idMounstro'] ?>">
              <label class="form-label">Seleciona el Tipo</label>
              <?php
              foreach ($tipos as $tipo) { ?>

                <div class="form-check">


                  <input type="checkbox" class="btn-check" id="check<?= $tipo['idTipo'] ?>_<?= $carta['idMounstro'] ?>" autocomplete="off" name="newtipos[]" value="<?= $tipo['idTipo'] ?>">
                  <label class="btn btn-primary" for="check<?= $tipo['idTipo'] ?>_<?= $carta['idMounstro'] ?>"><?= $tipo['nombreTipo'] ?></label>


                </div>
              <?php } ?>
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
              <button type="submit" class="btn btn-success" name="updateTipos">Confirmar
                modificacion</button>
            </form>




          </div>

        </div>
      </div>
    </div>

    <div class="modal fade" id="modalAtributo<?= $carta['idMounstro'] ?>" tabindex="-1" aria-labelledby="modalAtributo<?= $carta['idMounstro'] ?>" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel2">Actual :
              <?= $carta['Atributo'] ?>
            </h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">

            <form action="./php_controllers/cardController.php" method="POST" enctype="multipart/form-data">

              <input type="hidden" name="idMounstro" value="<?= $carta['idMounstro'] ?>">
              <select class="form-select" aria-label="Default select example" name='newAtributo'>
                <option selected>Selecciona un atributo</option>


                <?php
                foreach ($atributos as $atributo) { ?>
                  <option value="<?= $atributo['idAtributo'] ?>"><?= $atributo['nombreAtributo'] ?></option>
                <?php } ?>

              </select>
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
              <button type="submit" class="btn btn-success" name="updateAtribut">Confirmar
                modificacion</button>
            </form>




          </div>

        </div>
      </div>
    </div>

    <div class="modal fade" id="modalimg<?= $carta['idMounstro'] ?>" tabindex="-1" aria-labelledby="modalimg<?= $carta['idMounstro'] ?>" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel2">Actual :
              <img class="modalImg" src="./img/<?= $carta['img'] ?>" alt="">
            </h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">

            <form action="./php_controllers/cardController.php" method="POST" enctype="multipart/form-data">

              <input type="hidden" name="idMounstro" value="<?= $carta['idMounstro'] ?>">
              <label for="formFile" class="form-label">Imagen</label>
              <input class="form-control" type="file" id="formFile" name="newImg" required>
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
              <button type="submit" class="btn btn-success" name="updateImg">Confirmar
                modificacion</button>
            </form>




          </div>

        </div>
      </div>
    </div>




  <?php } ?>

  </div>





</body>


<script src="./js/app.js"></script>


</html>