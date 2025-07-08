@extends('layout.PlantillaUser') {{-- Asume que tienes un layout principal llamado app.blade.php --}}

@section('content')
<div class="container-fluid p-5 d-flex bg-primary justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="card p-5">
        <h1>Editar Perfil de {{ $user->name }} {{ $user->last_name }}</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

        <div class="card-body">
            <form action="{{ route('users.update', $user->user_id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT') {{-- Usa el método PUT para actualizaciones RESTful --}}

                <div class="form-group">
                    <label for="name">Nombre:</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                </div>

                <div class="form-group">
                    <label for="last_name">Apellido:</label>
                    <input type="text" class="form-control" id="last_name" name="last_name" value="{{ old('last_name', $user->last_name) }}" required>
                </div>

                <div class="form-group">
                    <label for="username">Nombre de Usuario:</label>
                    <input type="text" class="form-control" id="username" name="username" value="{{ old('username', $user->username) }}" required>
                </div>

                <div class="form-group">
                    <label for="email">Correo Electrónico:</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                </div>

                <div class="form-group">
                    <label for="phone_number">Número de Teléfono:</label>
                    <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ old('phone_number', $user->phone_number) }}">
                </div>

                <div class="form-group">
                    <label for="address">Dirección:</label>
                    <textarea class="form-control" id="address" name="address">{{ old('address', $user->address) }}</textarea>
                </div>

                <div class="form-group">
                    <label for="profile_img">Imagen de Perfil:</label>
                    @if ($user->profile_img_name)
                        <img src="{{ $user->profile_img_url }}" alt="Imagen de perfil actual" style="max-width: 150px; display: block; margin-bottom: 10px;">
                    @endif
                    <input type="file" class="form-control-file" id="profile_img" name="profile_img">
                    <small class="form-text text-muted">Deja en blanco para mantener la imagen actual.</small>
                </div>

                <div class="form-group">
                    <label for="password">Nueva Contraseña:</label>
                    <input type="password" class="form-control" id="password" name="password">
                    <small class="form-text text-muted">Deja en blanco para mantener la contraseña actual.</small>
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Confirmar Nueva Contraseña:</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                </div>

                <button type="submit" class="btn btn-primary">Actualizar Perfil</button>
            </form>
        </div>
    </div>
    
    
</div>
@endsection