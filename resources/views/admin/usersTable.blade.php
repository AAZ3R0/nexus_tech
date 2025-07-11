@extends('layout.PlantillaAdmin')
@section('content')

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>
<div class="container-fluid bg-primary  flex-column justify-content-center align-items-center"
    style="min-height: 100vh;">
    <br>
    <br>
    <br>
    <div class="container card text-white p-5" style="background-color: #1E2A30;">

        <div class="container">
            <h2>Listada de usuarios registrados</h2><br>

            @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            <div class="rounded overflow-hidden">
                <table class="table card-table  table-bordered border-primary mb-0  text-white"
                    style="background-color: #1E2A30;">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th class=text-white style="background-color:#1E2A30;">ID</th>
                            <th class=text-white style="background-color:#1E2A30;">Nombre(s)</th>
                            <th class=text-white style="background-color:#1E2A30;">Apellido(s)</th>
                            <th class=text-white style="background-color:#1E2A30;">Correo</th>
                            <th class=text-white style="background-color:#1E2A30;">Rol</th>
                            <th class=text-white style="background-color:#1E2A30;">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)

                        <tr>
                            <td class=text-white style="background-color: #27373F;">{{ $user->user_id }}</td>
                            <td class=text-white style="background-color: #27373F;">{{ $user->name }}</td>
                            <td class=text-white style="background-color: #27373F;">{{ $user->last_name }}</td>
                            <td class=text-white style="background-color: #27373F;">{{ $user->email }}</td>
                            <td class=text-white style="background-color: #27373F;">{{ $user->role->name ?? 'N/A' }}
                            </td>

                            <td style="background-color: #27373F;">
                                {{-- Botón VER: Asegúrate que el ID del modal es correcto --}}
                                <button type="button" class="btn btn-outline-info" data-bs-toggle="modal"
                                    data-bs-target="#ShowProduct{{ $user->user_id }}"><i class="bi bi-card-list"></i>
                                    Ver</button>

                                {{-- Botón ELIMINAR: Asegúrate que el ID del modal es correcto --}}
                                <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal"
                                    data-bs-target="#DeleteProduct{{ $user->user_id }}"> <i
                                        class="bi bi-trash-fill"></i> Banear</button>
                            </td>
                        </tr>

                        {{-- Modal SHOW (dentro del bucle) --}}
                        <div class="modal fade" id="ShowProduct{{ $user->user_id }}" tabindex="-1"
                            aria-labelledby="modalLabel{{ $user->user_id }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content bg-dark text-white">
                                    <div class="modal-header border-0">
                                        <h5 class="modal-title" id="modalLabel{{ $user->user_id }}">Perfil de Usuario
                                        </h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                            aria-label="Cerrar"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="card bg-dark text-white">
                                            <div class="card-body">
                                                <div class="row">
                                                    <!-- Columna de imagen (1/3) -->
                                                    <div class="col-md-4 text-center mb-3">
                                                        <img src="{{ asset('img/users/' . $user->profile_img_name) }}"
                                                            class="img-fluid rounded border border-secondary"
                                                            style="max-height: 200px;" alt="Imagen de perfil">
                                                    </div>

                                                    <!-- Columna de información (2/3) -->
                                                    <div class="col-md-8">
                                                        <h5 class="card-title">{{ $user->username }}</h5>
                                                        <p class="mb-3">
                                                            <span class="fw-semibold">N.º de cliente:</span>
                                                            <input type="text" class="form-control border-0"
                                                                value="{{ $user->user_id }}" disabled>
                                                        </p>

                                                        <p class="mb-3">
                                                            <span class="fw-semibold">Nombre(s):</span>
                                                            <input type="text" class="form-control border-0"
                                                                value="{{ $user->name }}" disabled>
                                                        </p>

                                                        <p class="mb-3">
                                                            <span class="fw-semibold">Apellido(s):</span>
                                                            <input type="text" class="form-control border-0"
                                                                value="{{ $user->last_name }}" disabled>
                                                        </p>

                                                        <p class="mb-3">
                                                            <span class="fw-semibold">Correo:</span>
                                                            <input type="text" class="form-control border-0"
                                                                value="{{ $user->email }}" disabled>
                                                        </p>

                                                        <p class="mb-3">
                                                            <span class="fw-semibold">Teléfono:</span>
                                                            <input type="text" class="form-control border-0"
                                                                value="{{ $user->phone_number }}" disabled>
                                                        </p>

                                                        <p class="mb-0">
                                                            <span class="fw-semibold">Dirección:</span>
                                                            <input type="text" class="form-control border-0"
                                                                value="{{ $user->address }}" disabled>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer border-0">
                                        <button type="button" class="btn btn-outline-light"
                                            data-bs-dismiss="modal">Regresar</button>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <!-- Delete modal -->
                        <div class="modal fade" id="DeleteProduct{{ $user->user_id }}" tabindex="-1"
                            aria-labelledby="deleteModalLabel{{ $user->user_id }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content bg-dark text-white">
                                    <div class="modal-header border-0">
                                        <h5 class="modal-title" id="deleteModalLabel{{ $user->user_id }}">¿Estás seguro
                                            que quieres banear este usuario?</h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                            aria-label="Cerrar"></button>
                                    </div>

                                    <form action="{{ route('admin.users.destroy', $user->user_id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <div class="modal-body">
                                            <div class="card bg-dark text-white ">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <!-- Imagen (1/3) -->
                                                        <div class="col-md-4 text-center mb-3">
                                                            <img src="{{ asset('img/users/' . $user->profile_img_name) }}"
                                                                class="img-fluid rounded border border-secondary"
                                                                style="max-height: 200px;" alt="Imagen de perfil">
                                                        </div>

                                                        <!-- Información (2/3) -->
                                                        <div class="col-md-8">
                                                            <h5 class="card-title">{{ $user->username }}</h5>
                                                            <p class="mb-3">
                                                                <span class="fw-semibold">N.º de cliente:</span>
                                                                <input type="text" class="form-control border-0"
                                                                    value="{{ $user->user_id }}" disabled>
                                                            </p>

                                                            <p class="mb-3">
                                                                <span class="fw-semibold">Nombre(s):</span>
                                                                <input type="text" class="form-control border-0"
                                                                    value="{{ $user->name }}" disabled>
                                                            </p>

                                                            <p class="mb-3">
                                                                <span class="fw-semibold">Apellido(s):</span>
                                                                <input type="text" class="form-control border-0"
                                                                    value="{{ $user->last_name }}" disabled>
                                                            </p>

                                                            <p class="mb-3">
                                                                <span class="fw-semibold">Correo:</span>
                                                                <input type="text" class="form-control border-0"
                                                                    value="{{ $user->email }}" disabled>
                                                            </p>

                                                            <p class="mb-3">
                                                                <span class="fw-semibold">Teléfono:</span>
                                                                <input type="text" class="form-control border-0"
                                                                    value="{{ $user->phone_number }}" disabled>
                                                            </p>

                                                            <p class="mb-0">
                                                                <span class="fw-semibold">Dirección:</span>
                                                                <input type="text" class="form-control border-0"
                                                                    value="{{ $user->address }}" disabled>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="modal-footer border-0">
                                            <button type="submit" class="btn btn-outline-danger">
                                                <i class="bi bi-trash-fill"></i> Banear
                                            </button>
                                            <button type="button" class="btn btn-outline-light"
                                                data-bs-dismiss="modal">Regresar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>


                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $users->links('vendor.pagination.bootstrap-5') }}
        </div>
    </div>
</div>

@endsection