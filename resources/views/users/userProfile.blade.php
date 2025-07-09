@extends('layout.PlantillaUser')
@section('content')

<div class="container-fluid d-flex bg-primary justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="card p-5" style="background-color: #1E2A30;">
         <h1 class="text-white">Perfil de {{ $user->name }} {{ $user->last_name }}</h1>
  <div class="card-body mt-0"> 
    <div class="row">
      {{-- Columna izquierda --}}
      <div class="col-12 col-md-4 text-center ">
        <img src="{{ asset('img/users/' . $user->profile_img_name) }}"
             alt="Foto de perfil"
             class="img-fluid rounded mb-3"
             style="max-width: 100%; height: auto;">
        <a href="{{ route('users.edit', $user->user_id) }}"
           class="btn btn-outline-warning w-100">
           <i class="bi bi-pencil-square"></i> Editar
        </a>
      </div>

{{-- Columna derecha --}}
<div class="col-12 col-md-8 text-white fs-5">     {{-- fs-5 ≈ 20 px --}}
  <h4 class="fw-semibold mb-4">{{ $user->username }}</h4>

  <p class="mb-3">
    <span class="fw-semibold">N.º de cliente:</span>
    {{ $user->user_id }}
  </p>

  <p class="mb-3">
    <span class="fw-semibold">Nombre(s):</span>
    {{ $user->name }}
  </p>

  <p class="mb-3">
    <span class="fw-semibold">Apellido(s):</span>
    {{ $user->last_name }}
  </p>

  <p class="mb-3">
    <span class="fw-semibold">Correo:</span>
    {{ $user->email }}
  </p>

  <p class="mb-3">
    <span class="fw-semibold">Teléfono:</span>
    {{ $user->phone_number }}
  </p>

  <p class="mb-0">
    <span class="fw-semibold">Dirección:</span>
    {{ $user->address }}
  </p>
</div>
    </div>
  </div>
</div>
</div>


@endsection