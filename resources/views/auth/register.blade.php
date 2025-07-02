@extends("layout.index")
@section('content')



    <h2>Registro</h2>

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" enctype="multipart/form-data" action="{{ url('/register') }}">
        @csrf
        <input type="text" name="name" placeholder="Nombre" value="{{ old('name') }}"><br>
        <input type="text" name="last_name" placeholder="Apellido" value="{{ old('last_name') }}"><br>
        <input type="text" name="username" placeholder="Usuario" value="{{ old('username') }}"><br>
        <input type="email" name="email" placeholder="Email" value="{{ old('email') }}"><br>
        <input type="password" name="password" placeholder="Contraseña"><br>
        <input type="password" name="password_confirmation" placeholder="Confirmar contraseña"><br>
        <input type="text" name="phone_number" placeholder="Teléfono" value="{{ old('phone_number') }}"><br>
        <input type="text" name="address" placeholder="Dirección" value="{{ old('address') }}"><br>
        <input type="file" name="profile_img_name" placeholder="Foto de perfil" value="{{ old('profile_img_name') }}"><br>
        <button type="submit">Registrarse</button>
    </form>

    @endsection