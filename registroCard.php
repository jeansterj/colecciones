<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./style/estilos.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</head>

<header>

<header>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">
        <img src="img/Logo_Yugioh.png" alt="Logo_Yugioh" style="width: 180px; height: 50px;" class="mr-2">
      </a>
      <button class="navbar-toggler ml-auto" type="button" data-bs-toggle="collapse"
        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
        aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Opciones de Cartas
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#">Crear</a></li>
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

<form class="bodyRegister">

<div class="container" style="color: white;">
<div class="card">
<div class="card-header">
    Mounstro
  </div>
  <div class="card-body">
  <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Nombre</label>
        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Kuriboh">
    </div>
    <div class="mb-3">
        <label for="exampleFormControlTextarea1" class="form-label">Descripcion</label>
        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Durante el cálculo de daño, si el monstruo de tu adversario ataca (Efecto Rápido): puedes descartar esta carta; no recibes daño de batalla de esa batalla."></textarea>
    </div>
    <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">ATK</label>
        <input type="number" class="form-control" id="exampleFormControlInput1" placeholder="300">
    </div>
    <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">DEF</label>
        <input type="number" class="form-control" id="exampleFormControlInput1" placeholder="200">
    </div>
    <div class="mb-3">
      <select class="form-select" aria-label="Default select example">
        <option selected>Selecciona un atributo</option>
        <option value="Luz">Luz</option>
        <option value="Oscuridad">Oscuridad</option>
        <option value="Fuego">Fuego</option>
        <option value="Agua">Agua</option>
        <option value="Tierra">Tierra</option>
        <option value="Viento">Viento</option>
  </select>
    </div>

    <label class="form-label">Seleciona el Tipo</label>


    <div class="form-check">
          <input type="checkbox" class="btn-check" id="Bestia-check" autocomplete="off">
          <label class="btn btn-primary" for="Bestia-check">Bestia</label>
        
          <input type="checkbox" class="btn-check" id="Lanzador-check" autocomplete="off">
          <label class="btn btn-primary" for="Lanzador-check">Lanzador de conjuros</label>
        
          <input type="checkbox" class="btn-check" id="Ciberso-check" autocomplete="off">
          <label class="btn btn-primary" for="Ciberso-check">Ciberso</label>
      
        <input type="checkbox" class="btn-check" id="Guerrero-check" autocomplete="off">
        <label class="btn btn-primary" for="Guerrero-check">Guerrero</label>

        <input type="checkbox" class="btn-check" id="Demonio-check" autocomplete="off">
        <label class="btn btn-primary" for="Demonio-check">Demonio</label>

        <input type="checkbox" class="btn-check" id="Bestia-Divina-check" autocomplete="off">
         <label class="btn btn-primary" for="Bestia-Divina-check">Bestia Divina</label>

        <br><br>

        <input type="checkbox" class="btn-check" id="Dragon-check" autocomplete="off">
         <label class="btn btn-primary" for="Dragon-check">Dragon</label>

        <input type="checkbox" class="btn-check" id="Bestia-Alada-check" autocomplete="off">
        <label class="btn btn-primary" for="Bestia-Alada-check">Bestia Alada</label>

        <input type="checkbox" class="btn-check" id="Ilusion-check" autocomplete="off">
        <label class="btn btn-primary" for="Ilusion-check">Ilusion</label>

        <input type="checkbox" class="btn-check" id="Maquina-check" autocomplete="off">
        <label class="btn btn-primary" for="Maquina-check">Maquina</label>

        <input type="checkbox" class="btn-check" id="Planta-check" autocomplete="off">
        <label class="btn btn-primary" for="Planta-check">Planta</label>

        <input type="checkbox" class="btn-check" id="Trueno-check" autocomplete="off">
        <label class="btn btn-primary" for="Trueno-check">Trueno</label>

        <br><br>
    </div>

      <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Nivel</label>
        <input type="number" name="nota_media" id="exampleFormControlInput1" min="0" max="12" class="form-control" required><br><br>
      </div>
     
      <div class="mb-3">
       <label for="formFile" class="form-label">Imagen</label>
       <input class="form-control" type="file" id="formFile">
      </div>

      <div class="col-12">
        <button class="btn btn-primary" type="submit">Submit form</button>
      </div>


      </div>

</div>
</div>


</form>


  
</body>

</html>