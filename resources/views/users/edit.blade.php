@extends('layout')

@section('contenido')
<div class="container">
    <h1>Editar usuario</h1>
    @if(session()->has('info'))
      <div class="alert alert-success">{{ session("info") }}</div>  
    @endif

    <form action="{{ route('usuarios.update',$user->id) }}" method="POST">
        @method('PUT')
       @include('users.form')

        <button class="btn btn-primary" >Enviar</button>
    </form>
</div>
@endsection