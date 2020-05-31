@csrf
@if($showFields)
<label for="nombre">Nombre</label>
<input class="form-control" type="text" name="nombre" value={{$message->nombre ?? old('nombre') }}>
{!! $errors->first('nombre','<span class="error">:message</span>') !!}<hr>

<hr>

<label for="email">Email</label>
<input class="form-control" type="text" name="email" value={{$message->email ?? old('email') }}>
{!! $errors->first('email','<span class="error">:message</span>') !!}<hr>
@endif
   

<hr>

<label for="mensaje">Mensaje</label>
<textarea class="form-control" name="mensaje" id="" cols="30" rows="10">{{$message->mensaje ?? old('mensaje') }}</textarea>
{!! $errors->first('mensaje','<span class="error">:message</span>') !!}<hr>


<button class="btn btn-primary" >{{  $btnText ?? 'Guardar'}}</button>