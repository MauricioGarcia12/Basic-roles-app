@extends('layout')
@section('contenido')
<div class="container">
    <h1>{{ $user->name }}</h1>

<table class="table">
    <tr>
        <th>Nombre:</th>
        <td>{{ $user->name }}</td>
    </tr>
    <tr>
        <th>Email:</th>
        <td>{{ $user->email }}</td>
    </tr>
    <tr>
        <th>Roles:</th>
        <td>
            @foreach ($user->roles as $role)
                {{ $role->name }}
            @endforeach
        </td>
    </tr>
</table>
@can('edit',$user)
<a href="{{ route('usuarios.edit',$user->id) }}" class="btn btn-lg btn-info">Editar</a>
@endcan

@can('destroy',$user)
    <form style="display: inline" 
        action="{{ route('usuarios.destroy', 
        $user->id) }}" 
        method="POST" >
        @method('DELETE')
        @csrf
        <button class="btn btn-danger btn-lg" type="submit">Eliminar</button>
    </form>
@endcan

</div>

    
@endsection