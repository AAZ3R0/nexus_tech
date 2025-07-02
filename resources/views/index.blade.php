<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <title>nexus_tech</title>
</head>

<body>

    <!-- 🔷 NAVBAR: barra superior de navegación -->
    <nav class="bg-dark text-white p-1 navbar navbar-expand-lg">
        <div class="container-fluid">

            <!-- Logo del sitio -->
            <a class="navbar-brand" href="#">
                <img src="{{ asset('img/Logo_pagina.png') }}" class="img-fluid" style="max-height: 100px;" alt="Logo">
            </a>

            <!-- Menú, búsqueda y carrito -->
            <div class="d-flex me-5 align-items-center">

                <!-- 🔹 Menú de navegación -->
                <ul class="navbar-nav flex-row me-3 gap-5">
                    <li class="nav-item me-2">
                        <a href="#" class="nav-link link-info px-2">Inicio</a>
                    </li>
                    <li class="nav-item me-2">
                        <a href="#" class="nav-link link-info px-2">Catálogo</a>
                    </li>
                    <li class="nav-item me-2">
                        <a href="#" class="nav-link link-info px-2">Sobre nosotros</a>
                    </li>
                    <li class="nav-item me-5">
                        <a href="#" class="nav-link link-danger px-2">Cerrar sesión</a>
                    </li>
                </ul>

                <!-- 🔹 Barra de búsqueda -->
                <form class="d-flex align-items-center me-3" role="search" style="position: relative; max-width: 500px;">
                    <input class="form-control" type="search" placeholder="Buscar" aria-label="Search" style="padding-right: 100px;">
                    <button class="btn btn-outline-success position-absolute" type="submit"
                            style="top: 0; right: 0; height: 100%; border-top-left-radius: 0; border-bottom-left-radius: 0;">
                        <i class="bi bi-search"></i>
                    </button>
                </form>

                <!-- 🔹 Botón del carrito -->
                <button class="btn btn-outline-light ms-2" type="button">
                    <i class="bi bi-cart2"></i>
                </button>

            </div>
        </div>
    </nav><br>

    <!-- 🔻 Contenido dinámico (Blade) -->
    @yield('content')

    <!-- 🔸 FOOTER: pie de página fijo -->
    <footer class="footer fixed-bottom bg-dark text-light py-3">
        <div class="container">
            <div class="row align-items-center text-center text-md-start justify-content-between">
                
                <!-- 🔹 Columna 1: Texto informativo de la empresa -->
                <div class="col-md-4 mb-2 mb-md-0">
                    <small>
                        <p class="mb-1 fw-bold">✨En NexusTech, ¡te ofrecemos los mejores proveedores! ✨</p>
                        <ul class="list-unstyled mb-0">
                            <li>Componentes y piezas de equipos de cómputo.</li>
                            <li>Productos tecnológicos de calidad.</li>
                        </ul>
                    </small>
                </div>

                <!-- 🔹 Columna 2: Logo centrado -->
                <div class="col-md-2 mb-2 mb-md-0 text-center">
                    <a class="navbar-brand" href="#">
                        <img src="{{ asset('img/Logo_pagina.png') }}" class="img-fluid" style="max-height: 70px;" alt="Logo">
                    </a>
                </div>

                <!-- 🔹 Columna 3: Información de contacto y redes sociales -->
                <div class="col-md-6 mb-2 mb-md-0">
                    <div class="row">
                        <!-- Contacto -->
                        <div class="col-md-6">
                            <p class="mb-1 fw-bold">Contáctanos</p>
                            <p class="mb-0"><i class="bi bi-envelope"></i> contacto@nexus.com</p>
                            <p class="mb-0"><i class="bi bi-telephone"></i> +52 656 123 4567</p>
                        </div>

                        <!-- Redes sociales -->
                        <div class="col-md-6 text-md-end">
                            <p class="mb-1">Nuestras redes sociales</p>
                            <a href="https://facebook.com" target="_blank" class="btn btn-outline-light btn-sm me-2">
                                <i class="bi bi-facebook"></i>
                            </a>
                            <a href="https://instagram.com" target="_blank" class="btn btn-outline-light btn-sm">
                                <i class="bi bi-instagram"></i>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </footer>

</body>
</html>
