<?php

require_once('./php_librarys/bd.php');

$cartas = selectCard();
$tipos = selectTypes();
$atributos = selectAtribut();



?>


<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="./style/estilos.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
  </script>

</head>

<header>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">
        <img src="img/Logo_Yugioh.png" alt="Logo_Yugioh" style="width: 180px; height: 50px;" class="mr-2">
      </a>
      <button class="navbar-toggler ml-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>


      <a href="./registroCard.php">Crear</a>
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


  <div class="container">


    <?php
    foreach ($cartas as $carta) { ?>

      <div class="card clickable-card " style="width: 18rem;">
        <div class="card bg-dark" style="width: 18rem; color: white;">
          <img src="img/<?php echo $carta['img']; ?>" class="card-img-top" alt="...">
          <div class="card-body">


            <h4><button id="nivel<?php echo $carta['idMounstro'] ?>" disabled data-bs-toggle="modal" data-bs-target="#modalNivel<?= $carta['idMounstro'] ?>">
                <?php echo "Nivel " . $carta['nivel'] ?></button></h4>

            <h4><button id="atributo<?php echo $carta['idMounstro'] ?>" disabled data-bs-toggle="modal" data-bs-target="#modalAtributo<?= $carta['idMounstro'] ?>">
                <?php echo "Atributo " . $carta['Atributo'] ?></button></h4>

            <h2 class="card-title"><button id="nombre<?php echo $carta['idMounstro'] ?>" disabled data-bs-toggle="modal" data-bs-target="#modalnombre<?= $carta['idMounstro'] ?>">
                <?php echo  $carta['nombre'] ?></button></h2>

            <h4><button id="tipo<?php echo $carta['idMounstro'] ?>" disabled data-bs-toggle="modal" data-bs-target="#modalTipos<?= $carta['idMounstro'] ?>">
                <?php echo "Tipo  " . $carta['Tipos'] ?></button></h4>

            <p class="card-text"><button id="descripcion<?php echo $carta['idMounstro'] ?>" disabled data-bs-toggle="modal" data-bs-target="#modalDescripcion<?= $carta['idMounstro'] ?>">
                <?php echo $carta['descripcion'] ?></button></p>

            <p><button id="atkBut<?php echo $carta['idMounstro'] ?>" disabled data-bs-toggle="modal" data-bs-target="#modalAtaque<?= $carta['idMounstro'] ?>">
                <?php echo $carta['ataque'] . " ATK" ?></button></p>

            <p><button id="defBut<?php echo $carta['idMounstro'] ?>" disabled data-bs-toggle="modal" data-bs-target="#modalDefensa<?= $carta['idMounstro'] ?>">
                <?php echo $carta['defensa'] . " DEF" ?></button></p>

            <button id="habilitar<?php echo $carta['idMounstro'] ?>" onclick="habilitarBotones(<?php echo $carta['idMounstro'] ?>)">modificacion</button>
            <button style="display: none;" id="deshabilitar<?php echo $carta['idMounstro'] ?>" onclick="deshabilitarBotones(<?php echo $carta['idMounstro'] ?>)">completar modificacion</button>
            <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalConfirDelete<?= $carta['idMounstro'] ?>">Eliminar Carta</button>

          </div>
        </div>
      </div>

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
                <button type="submit" class="btn btn-primary" name="updateNombre">Confirmar
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
                <button type="submit" class="btn btn-primary" name="updateDescripcion">Confirmar
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
                <input autofocus class="form-control mb-3" type="text" name="newNivel">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary" name="updateNivel">Confirmar
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
                <input autofocus class="form-control mb-3" type="text" name="newnAtaque">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary" name="updateAtk">Confirmar
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
                <input autofocus class="form-control mb-3" type="text" name="newDefensa">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary" name="updateDef">Confirmar
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
                <button type="submit" class="btn btn-primary" name="updateTipos">Confirmar
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
                <button type="submit" class="btn btn-primary" name="updateAtribut">Confirmar
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