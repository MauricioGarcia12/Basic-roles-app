@extends('layout')

@section('contenido')
<div class="container-fluid">
    <h1 class="text-center">Usuarios</h1>
<a href="{{ route('usuarios.create') }}" class=" float-right mb-2 btn btn-success ">Crear Usuario</a>

<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Email</th>
            <th>Role</th>
            <th>Notas</th>
            <th>Etiquetas</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>
                {{ $user->roles->pluck('name')->implode(', ') }}
            </td>
            <td>{{ $user->note->body ?? 'No hay notas' }}</td>
            <td>{{ $user->tags->pluck('name_tag')->implode(', ') ?? 'No hay etiquetas' }}</td>
            <td>
                <a class="btn btn-info btn-xs"
                    href="{{ route('usuarios.edit',$user->id) }}">
                    Editar
                </a>
                <form style="display: inline" 
                      action="{{ route('usuarios.destroy', 
                      $user->id) }}" 
                      method="POST" >
                    @method('DELETE')
                    @csrf
                    <button class="btn btn-danger btn-xs" type="submit">Eliminar</button>
                </form>
            </td>

        </tr>
            
        @endforeach
       
    </tbody>

</table>
</div>

    
@endsection