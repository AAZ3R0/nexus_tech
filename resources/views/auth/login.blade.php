@extends("layout.index")
@section('content')



    <h2>Login</h2>

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ url('/login') }}">
        @csrf
        <input type="text" name="username" placeholder="Usuario" value="{{ old('username') }}"><br>
        <input type="password" name="password" placeholder="Contraseña"><br>
        <button type="submit">Iniciar sesión</button>
    </form>

@endsection