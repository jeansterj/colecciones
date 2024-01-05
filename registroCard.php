<?php

include('./php_librarys/bd.php');

$tipos = selectTypes();
$atributos = selectAtribut();

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
      <form class="d-flex" action="./busquedaCard.php" method="POST">
        <input class="form-control me-2" type="search" placeholder="Buscar" aria-label="Search" name="nombre">
        <button class="btn btn-outline-success" type="submit">Buscar</button>
      </form>
      </ul>
    </div>
    </div>
  </nav>
</header>


<body>

  <form action="./php_controllers/cardController.php" method="post" class="bodyRegister">
    <div class="container" style="color: white;">

      <?php  require_once('./php_partials/mensajes.php');


      if (isset($_SESSION['carta'])) {
        $carta = $_SESSION['carta'];
        unset($_SESSION['carta']);
      } else {

        $carta = [
          'nombre' => '',
          'descripcion' => '',
          'nivel' => '',
          'atributo' => '',
          'ataque' => '',
          'defensa' => '',
          'img' => ''
        ];
      } 
      ?>


<div class="card formAjust">
        <div class="card-header">
          Mounstro
        </div>
        <div class="card-body">
          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Nombre</label>
            <input type="text" required class="form-control" id="exampleFormControlInput1" name='nombre' placeholder="Kuriboh" maxlength="22" value="<?php  echo $carta['nombre'];  ?>">
          </div>
          <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Descripcion</label>
            <textarea required class="form-control" id="exampleFormControlTextarea1" rows="3" name='descripcion' maxlength="100" 
             placeholder="Durante el cálculo de daño, si el monstruo de tu adversario ataca (Efecto Rápido): puedes descartar esta carta; no recibes daño de batalla de esa batalla."></textarea>
          </div>
          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">ATK</label>
            <input type="number" class="form-control" id="exampleFormControlInput1" name='ataque' placeholder="300" required min="0" max="9999" value="<?php  echo $carta['ataque']; ?>">
          </div>
          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">DEF</label>
            <input type="number" class="form-control" id="exampleFormControlInput1" name='defensa' placeholder="200" min="0" max="9999" value="<?php  echo $carta['defensa'];  ?>">
          </div>

          <div class="mb-3">
            <select class="form-select" aria-label="Default select example" name='atributo'>
              <option selected>Selecciona un atributo</option>
              <?php foreach ($atributos as $atributo) : ?>
                <option required value="<?= $atributo['idAtributo'] ?>" <?php  echo ($carta['atributo'] == $atributo['idAtributo']) ? 'selected' : '';  ?>>
                  <?= $atributo['nombreAtributo'] ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>

          <label class="form-label">Seleciona el Tipo</label>
          <?php foreach ($tipos as $tipo) : ?>
            <div class="form-check">
              <input type="checkbox" class="btn-check" id="check<?= $tipo['idTipo'] ?>" autocomplete="off" name="tipos[]" value="<?= $tipo['idTipo'] ?>" >
              <label class="btn btn-primary" for="check<?= $tipo['idTipo'] ?>"><?= $tipo['nombreTipo'] ?></label>
            </div>
          <?php endforeach; ?>
          <br><br>

          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Nivel</label>
            <input type="number" name="nivel" id="exampleFormControlInput1" min="0" max="12" class="form-control" required value="<?php  echo $carta['nivel'];  ?>"><br><br>
          </div>

          <div class="mb-3">
            <label for="formFile" class="form-label">Imagen</label>
            <input class="form-control" type="file" id="formFile" name="img" required>
          </div>

          <div class="col-12">
            <button class="btn btn-primary" type="submit" name="insert">Registrar Carta</button>
            <button class="btn btn-danger" onclick="window.location.href='./index.php';">Cancelar</button>
          </div>
        </div>
      </div>
    </div>


  </form>



</body>

</html>