@extends('layout.PlantillaUser')
@section('content')

<div class="container-fluid d-flex bg-primary justify-content-center align-items-center" style="min-height: 100vh;">

    <div class="container text-light m-5">
        <h1>Perfil de usuario</h1>

        <div class="card container">
            <div class="card-body">
                <h5 class="card-title">{{ $user->username }}</h5>
                <p class="card-text"><strong>Número de cliente:</strong> {{ $user->user_id }}</p>
                <p class="card-text"><strong>Nombres(s):</strong> {{ $user->name }}</p>
                <p class="card-text"><strong>Apellido(s):</strong> {{ $user->last_name }}</p>
                <p class="card-text"><strong>Correo:</strong> {{ $user->email }}</p>
                <p class="card-text"><strong>Número de teléfono:</strong> {{ $user->phone_number }}</p>
                <p class="card-text"><strong>Dirección:</strong> {{ $user->address }}</p>
                <p class="card-text"><strong>Imagen:</strong></p>
                <img src="{{ asset('img/users/' . $user->profile_img_name) }}" style="max-width: 150px; height: auto;">
                
            </div>
            <a class="btn btn-outline-warning m-3" href=" {{ route('users.edit', $user->user_id) }} "><i class="bi bi-pencil-square"></i>Editar</a>
        </div>
    </div>
    
</div>


@endsection