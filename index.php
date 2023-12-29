<?php

require_once('./php_librarys/bd.php');

$cartas = selectCard();

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
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Opciones de Cartas
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="./registroCard.php">Crear</a></li>
              <li><a class="dropdown-item" href="#">Modificar</a></li>
              <li><a class="dropdown-item" href="#">Eliminar</a></li>
            </ul>
          </li>
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

            <h4><button id="nivel<?php echo $carta['idMounstro'] ?>" disabled><?php echo "Nivel " . $carta['nivel'] ?></button></h4>

            <h4><button id="atributo<?php echo $carta['idMounstro'] ?>" disabled><?php echo "Atributo " . $carta['Atributo'] ?></button></h4>

            <h2 class="card-title"><button id="nombre<?php echo $carta['idMounstro'] ?>" disabled><?php echo  $carta['nombre'] ?></button></h2>

            <h4><button id="tipo<?php echo $carta['idMounstro'] ?>" disabled><?php echo "Tipo  " . $carta['Tipos'] ?></button></h4>

            <p class="card-text"><button id="descripcion<?php echo $carta['idMounstro'] ?>" disabled><?php echo $carta['descripcion'] ?></button></p>

            <p><button id="atkBut<?php echo $carta['idMounstro'] ?>" disabled><?php echo $carta['ataque'] . " ATK" ?></button></p>

            <p><button id="defBut<?php echo $carta['idMounstro'] ?>" disabled data-bs-toggle="modal" data-bs-target="#modalnombreusu<?= $carta['idMounstro'] ?>">
            <?php echo $carta['defensa'] . " DEF" ?></button></p>

            <button class="habilitar" id="habilitar" onclick="habilitarBotones(<?php echo $carta['idMounstro'] ?>)">modificacion</button>
            <button class="deshabilitar" id="deshabilitar" onclick="deshabilitarBotones(<?php echo $carta['idMounstro'] ?>)">completar modificacion</button>

          </div>
        </div>
      </div>



      <div class="modal fade" id="modalnombreusu<?= $carta['idMounstro'] ?>" tabindex="-1" aria-labelledby="modalnombreusu<?= $carta['idMounstro'] ?>" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel2">Actual :
            <?= $carta['nombre'] ?>
          </h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

          <form action="" method="POST" enctype="multipart/form-data">

            <input type="hidden" name="idMounstro" value="<?= $carta['idMounstro'] ?>">
            <input autofocus class="form-control mb-3" type="text" name="newnombreUsuario">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary" name="updatenombreUsuario">Confirmar
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