@extends('layout')

@section('contenido')
<div class="container">
    <h1>Editar Mensaje de</h1>

<form  action="{{ route('messages.update',$message->id) }}" method="POST">
    @method('PUT')
    @include('messages.form',[
        'btnText'=>'Actualizar',
        'showFields'=>!$message->user_id

        ])

</form>
</div>
@endsection