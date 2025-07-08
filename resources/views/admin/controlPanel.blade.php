@extends('layout.PlantillaAdmin')
@section('content')

    <h1>Bienvenido {{Auth::user()->username}}</h1>

@endsection