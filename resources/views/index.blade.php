<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <title>nexus_tech</title>
</head>

<body>
    <nav class="bg-dark text-white p-2 navbar navbar-expand-lg">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        
                        <img src="{{ asset('img/Logo_pagina.png') }}" class="img-responsive col-3">
                        
                        
                        <li class="nav-item me-auto">
                            <a href="#" class="nav-link link-info">Inicio</a>
                        </li>
                        <li class="nav-item me-auto">
                            <a href="#" class="nav-link link-info">Catálogo</a>
                        </li>
                        <li class="nav-item me-auto">
                            <a href="#" class="nav-link link-info">Sobre nosotros</a>
                        </li>
                        <li class="nav-item me-auto">
                            <a href="#" class="nav-link link-danger">Cerrar sesión</a>
                        </li>
                    </ul>
                </div>
                <div class="col">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                    <form class="d-flex">
                        
                    </form>
                </div>
            </div>
        </div>
    </nav><br>
    
    @yield('content')

    <footer class="footer fixed-bottom">
        <div class="contariner mt-auto bg-dark text-light p-5">
            <span>Contáctanos!!!!</span>
        </div>
    </footer>
</body>
</html>