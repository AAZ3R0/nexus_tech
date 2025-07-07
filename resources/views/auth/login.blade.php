@extends("layout.index")
@section('content')

<div class="container-fluid d-flex justify-content-center align-items-center" style="min-height: 100vh; background-color: #111B1F;">
    <div class="card p-4 shadow-lg" style="min-width: 320px; max-width: 600px; width: 100%; background-color: #1E2A30; color: white;">
        <h2 class="text-center mb-4 text-white">Login</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ url('/login') }}">
            @csrf

            <div class="mb-3">
                <input type="text" name="username" class="form-control bg-light text-white border-0" placeholder="Usuario" value="{{ old('username') }}">
            </div>

            <div class="mb-3">
                <input type="password" name="password" class="form-control bg-light text-white border-0" placeholder="Contraseña">
            </div>

            <button type="submit" class="btn btn-primary w-100">Iniciar sesión</button>
        </form>

        <p class="mt-3 mb-0 text-white">
            ¿No tienes una cuenta? <a href="{{ url('/register') }}" class="text-decoration-none text-info">Regístrate</a>
        </p>
    </div>
</div>

@endsection

