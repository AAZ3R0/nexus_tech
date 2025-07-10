@extends('layout.PlantillaAdmin')

@section('content')
<div class="container-fluid bg-primary d-flex flex-column justify-content-center align-items-center" style="min-height: 100vh;">
     <div class="text-center text-white mt-3">
        <h2>¡Bienvenido {{ Auth::user()->username }}!</h2>
    </div>
    <div class="container mt-4 px-4 p-5">
        <div class="d-flex flex-column align-items-center p-5 rounded-4" style="background-color: #0d1b1e;">
            
            <!-- Título Panel de control dentro del mismo contenedor -->
            <h2 class="text-white mb-4 ">Panel de control</h2>

            <!-- Fila de botones -->
            <div class="d-flex justify-content-between gap-5 w-100 ">
                
                <!-- Botón Productos -->
                <a href="{{ route('admin.products.index') }}" class="text-decoration-none flex-fill">
                    <div class="d-flex flex-column align-items-center bg-dark rounded-4 p-4 h-120 w-100 ">
                        <svg xmlns="http://www.w3.org/2000/svg" width="350" height="350" fill="currentColor" class="bi bi-box2" viewBox="0 0 16 16">
                            <path d="M2.95.4a1 1 0 0 1 .8-.4h8.5a1 1 0 0 1 .8.4l2.85 3.8a.5.5 0 0 1 .1.3V15a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1V4.5a.5.5 0 0 1 .1-.3zM7.5 1H3.75L1.5 4h6zm1 0v3h6l-2.25-3zM15 5H1v10h14z"/>
                        </svg>
                        <span class="text-white fs-4 mt-auto">Productos</span>
                    </div>
                </a>

                <!-- Botón Usuarios -->
                <a href="{{ route('admin.users.index') }}" class="text-decoration-none flex-fill">
                    <div class="d-flex flex-column align-items-center bg-dark rounded-4 p-4 h-120 w-100 ">
                        <svg xmlns="http://www.w3.org/2000/svg" width="350" height="350" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                            <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z"/>
                        </svg>
                        <span class="text-white fs-4 mt-auto">Usuarios</span>
                    </div>
                </a>

            </div>
        </div>
    </div>
</div>


@endsection
