@extends('layout.index')
@section('content')

<div class="container">
    <h2>Listada de usuarios registrados</h2><br>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre(s)</th>
                <th>Apellido(s)</th>
                <th>Correo</th>
                <th>Rol</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                
                <tr>
                    <td>{{ $user->user_id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->last_name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role->name ?? 'N/A' }}</td>
                    
                    <td>
                        {{-- Botón VER: Asegúrate que el ID del modal es correcto --}}
                        <button type="button" class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#ShowProduct{{ $user->user_id }}">Ver</button>

                        {{-- Botón ELIMINAR: Asegúrate que el ID del modal es correcto --}}
                        <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#DeleteProduct{{ $user->user_id }}">Banear</button>
                    </td>
                </tr>

                {{-- Modal SHOW (dentro del bucle) --}}
                <div class="modal fade" id="ShowProduct{{ $user->user_id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Detalles del producto</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $user->username }}</h5>
                                        <p class="card-text"><strong>ID:</strong> {{ $user->user_id }}</p>
                                        <p class="card-text"><strong>Nombres(s):</strong> {{ $user->name }}</p>
                                        <p class="card-text"><strong>Apellido(s):</strong> {{ $user->last_name }}</p>
                                        <p class="card-text"><strong>Correo:</strong> {{ $user->email }}</p>
                                        <p class="card-text"><strong>Número de teléfono:</strong> {{ $user->phone_number }}</p>
                                        <p class="card-text"><strong>Dirección:</strong> {{ $user->address }}</p>
                                        <p class="card-text"><strong>Rol:</strong> {{ $user->role->name ?? 'N/A' }}</p>
                                        <p class="card-text"><strong>Imagen:</strong></p>
                                        <img src="{{ asset('img/users/' . $user->profile_img_name) }}" style="max-width: 150px; height: auto;">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Regresar</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Delete modal -->
                <div class="modal fade" id="DeleteProduct{{ $user->user_id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">¿Estás seguro que quieres banear este usuario?</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="{{ route('admin.users.destroy', $user->user_id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <div class="modal-body">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $user->username }}</h5>
                                        <p class="card-text"><strong>ID:</strong> {{ $user->user_id }}</p>
                                        <p class="card-text"><strong>Nombres(s):</strong> {{ $user->name }}</p>
                                        <p class="card-text"><strong>Apellido(s):</strong> {{ $user->last_name }}</p>
                                        <p class="card-text"><strong>Correo:</strong> {{ $user->email }}</p>
                                        <p class="card-text"><strong>Número de teléfono:</strong> {{ $user->phone_number }}</p>
                                        <p class="card-text"><strong>Dirección:</strong> {{ $user->address }}</p>
                                        <p class="card-text"><strong>Rol:</strong> {{ $user->roles->name ?? 'N/A' }}</p>
                                        <p class="card-text"><strong>Imagen:</strong></p>
                                        <img src="{{ asset('img/users/' . $user->profile_img_name) }}" style="max-width: 150px; height: auto;">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-danger" data-bs-dismiss="modal">Banear</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Regresar</button>
                                </div>
                            </form>
                                
                        </div>
                    </div>
                </div>
                
            @endforeach
        </tbody>
    </table>

    {{ $users->links('vendor.pagination.bootstrap-5') }}
</div>


@endsection