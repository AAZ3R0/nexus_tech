@extends("layout.PlantillaGuest")
@section('content')

<div class="container-fluid d-flex bg-primary justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="card p-4 shadow-lg" style="min-width: 320px; max-width: 600px; width: 100%; background-color: #1E2A30; color: white;">
        <h2 class="text-center mb-4 text-white">Registro</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" enctype="multipart/form-data" action="{{ url('/register') }}">
            @csrf

            <div class="mb-3">
                <input type="text" name="name" class="form-control bg-light text-white border-0" placeholder="Nombre" value="{{ old('name') }}">
            </div>

            <div class="mb-3">
                <input type="text" name="last_name" class="form-control bg-light text-white border-0" placeholder="Apellido" value="{{ old('last_name') }}">
            </div>

            <div class="mb-3">
                <input type="text" name="username" class="form-control bg-light text-white border-0" placeholder="Usuario" value="{{ old('username') }}">
            </div>

            <div class="mb-3">
                <input type="email" name="email" class="form-control bg-light text-white border-0" placeholder="Email" value="{{ old('email') }}">
            </div>

            <div class="mb-3">
                <input type="password" name="password" class="form-control bg-light text-white border-0" placeholder="Contraseña">
            </div>

            <div class="mb-3">
                <input type="password" name="password_confirmation" class="form-control bg-light text-white border-0" placeholder="Confirmar contraseña">
            </div>

            <div class="mb-3">
                <input type="text" name="phone_number" class="form-control bg-light text-white border-0" placeholder="Teléfono" value="{{ old('phone_number') }}">
            </div>

            <div class="mb-3">
                <input type="text" name="address" class="form-control bg-light text-white border-0" placeholder="Dirección" value="{{ old('address') }}">
            </div>

            <div class="mb-3">
                <input type="file" name="profile_img_name" class="form-control bg-light text-white border-0">
            </div>

            <button type="submit" class="btn btn-primary w-100">Registrarse</button>
        </form>

        <p class="mt-3 text-center mb-0 text-white">
            ¿Ya tienes una cuenta? <a href="{{ url('/login') }}" class="text-decoration-none text-info">Inicia sesión</a>
        </p>
    </div>
</div>

@endsection
