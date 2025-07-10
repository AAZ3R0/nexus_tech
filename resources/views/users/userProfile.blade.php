@extends('layout.PlantillaUser')
@section('content')


    <div class="card p-5 container bg-accent1">
         <h1 class="text-white">Perfil de {{ $user->name }} {{ $user->last_name }}</h1>
      <div class="card-body mt-0"> 
        <div class="row">
          {{-- Columna izquierda --}}
          <div class="col-12 col-md-4 text-center ">
            <img src="{{ asset('img/users/' . $user->profile_img_name) }}"
                alt="Foto de perfil"
                class="img-fluid rounded mb-4 w-100"
                >
            <a href="{{ route('users.edit', $user->user_id) }}"
              class="btn btn-outline-warning w-100">
              <i class="bi bi-pencil-square"></i> Editar
            </a>
          </div>

          {{-- Columna derecha --}}
          <div class="col-12 col-md-8 text-white fs-5">     {{-- fs-5 ≈ 20 px --}}
            <h4 class="fw-semibold mb-4">Nombre de usuario: {{ $user->username }}</h4>

            <p class="mb-3">
              <span class="fw-semibold">N.º de cliente:</span>
              <input type="text" class="form-control" value="{{ $user->user_id }}" disabled>
            </p>

            <p class="mb-3">
              <span class="fw-semibold">Nombre(s):</span>
              <input type="text" class="form-control" value="{{ $user->name }}" disabled>
            </p>

            <p class="mb-3">
              <span class="fw-semibold">Apellido(s):</span>
              {{ $user->last_name }}
              <input type="text" class="form-control" value="{{ $user->last_name }}" disabled>
            </p>

            <p class="mb-3">
              <span class="fw-semibold">Correo:</span>
              <input type="text" class="form-control" value="{{ $user->email }}" disabled>
            </p>

            <p class="mb-3">
              <span class="fw-semibold">Teléfono:</span>
              <input type="text" class="form-control" value="{{ $user->phone_number }}" disabled>
            </p>

            <p class="mb-0">
              <span class="fw-semibold">Dirección:</span>
              <input type="text" class="form-control" value="{{ $user->address }}" disabled>
            </p>
          </div>
        </div>
      </div>
    </div>


@endsection