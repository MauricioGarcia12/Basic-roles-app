@extends('layout')

@section('contenido')
<div class="container-fluid">
    <h1 class="text-center">Todos los mensaje</h1>

<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Email</th>
            <th>Mensaje</th>
            <th>Notas</th>
            <th>Etiquetas</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($messages as $message)
         <tr>
            <td>{{ $message->id }}</td>
            @if($message->user_id)
                <td>
                    <a class="text-info" href="{{ route('usuarios.show',$message->user_id) }}">
                        {{ $message->user->name }}
                    </a>
                </td>

                <td>{{ $message->user->email }}</td>
            @else
                <td>{{ $message->nombre}}</td>
                <td >{{ $message->email }}</td>
            @endif
             <td>
                <a class='text-info' href="{{ route('messages.show',$message->id) }}">
                    {{ $message->mensaje }}
                </a>
             </td>

             <td>{{$message->note ? $message->note->body: '' ?? 'No hay mensaje'}}</td>
             <td>{{ $message->tags->pluck('name_tag')->implode(', ') ?? 'No hay etiquetas' }}</td>

             <td>
                <a class="btn btn-info btn-xs" href="{{ route('messages.edit',$message->id) }}">
                    Editar
                </a>
                <form style="display: inline" action="{{ route('messages.destroy', $message->id) }}" method="POST" >
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