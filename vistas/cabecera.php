<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Padalea</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>

<body>
    <header class="bg-dark navbar shadow sticky-top">
        <div>
            <a class=" navbar-brand px-3 text-light" href="index.php">Padalea</a>
        </div>

        <form class="form-inline invisible">
            <div class="d-flex nowrap">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </div>

        </form>

        <div class="d-flex nowrap px-3">
            <div class="navbar-text px-3">
                <span class="text-secondary">Welcome: </span> <span class="text-primary"><?= unserialize($_SESSION["usuario"])->getApodo() ?></span>
            </div>

            <div>
                <a href="index.php?accion=cerrarSesion"><button class="btn btn-outline-danger my-2 my-sm-0">Cerrar sesion</button></a>

            </div>
        </div>
    </header>