@extends('layout')

@section('contenido')
<div class="container">
    <h1 class="text-center">Crear Usuario</h1>

    <form action="{{ route('usuarios.store') }}" method="POST">
       @include('users.form',['user'=>new App\User])
       
        <button class="btn btn-primary" >Guardar</button>
    </form>

</div>
    
@endsection