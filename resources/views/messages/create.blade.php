<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Contactos</title>
</head>
<body>

    @extends('layout')
    
    @section('contenido')
    <div class="container">

        <h1>Contenido</h1>    

        @if(session()->has('info'))

            <h3>{{ session('info') }}</h3>

          @else
        <form action="{{ route('messages.store') }}" method="POST">

          @include('messages.form',[
            'message'=> new App\Message,
            'showFields'=>auth()->guest()
            ])

        </form>
        @endif
    </div>

    @endsection
</body>
</html>