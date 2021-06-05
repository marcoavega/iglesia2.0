<?php
print('
<!DOCTYPE html>
<html lang="es-MX">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Escuela Sabática</title>
    <meta name="description" content="Bienvenidos.">
    <link rel="shortcut icon" type="image/png" href="./public/img/favicon.png">
    <link rel="stylesheet" type="text/css" href="./public/bootstrap-4.5.3/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="./public/fontawesome/css/all.css">
    <link rel="stylesheet" type="text/css" href="./public/reveal/dist/theme/fonts/fuentes/fuentes.css">
    <link rel="stylesheet" href="./public/css/project.css">

</head>

<body>
    ');

if ($_SESSION['ok']) {
    print('
    
    <nav class="navbar navbar-expand-sm col-sm-12 ">
    <div class="col-md-2 nav1">
        <a class="navbar-brand sm-12 md-2 nav1" href="./">Iglesia de Dios</a>
    </div>
    <div class="col-md-10 nav2">
        <a class="navbar-brand sm-12 md-2" href="hymn-list"><i class="fas fa-music"></i>Himnario</a>

        <li class="nav-item dropdown navbar-brand sm-12 md-2">
        <a class="nav-link dropdown-toggle navbar-brand" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-school"></i>  
        Lecciones
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="lessons">Ver Lecciones</a>
          <a class="dropdown-item" href="capture-lessons">Capturar lecciones</a>
        </div>
      </li>

        
        <a class="navbar-brand sm-12 md-2" href="users"><i class="fas fa-users"></i>Usuarios</a>
        <a class="navbar-brand sm-12 md-2" href="salir"><i class="fas fa-sign-out-alt"></i>Salir</a>
    </div>
    </nav>

    ');
}

print('
    <div class="container-fluid">

        ');
