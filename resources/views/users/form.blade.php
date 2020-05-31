@csrf

<label for="name">Nombre</label><br>
<input type="text" name="name" value={{ $user->name ?? old('name') }}>
{!! $errors->first('name','<span class="error">:message</span>') !!}<hr>


<label for="email">Email</label><br>
<input type="text" name="email" value={{ $user->email ?? old('email')}}>
{!! $errors->first('email','<span class="error">:message</span>') !!}<hr>


@unless ($user->id)

<label for="password">Password</label><br>
<input type="text" name="password" value={{ $user->password ?? old('password') }}>
{!! $errors->first('password','<span class="error">:message</span>') !!}<hr>

<label for="password_confirmation">Confirm Password</label><br>
<input type="text" name="password_confirmation" value={{ $user->password ?? old('password_confirmation') }}>
{!! $errors->first('password_confirmation','<span class="error">:message</span>') !!}<hr>

    
@endunless


<div class="checkbox-light">
  @foreach ($roles as $id=>$name)  
  <label for="">
        <input 
        type="checkbox" 
        value="{{ $id }}" 
        {{ $user->roles->pluck('id')->contains($id) ?'checked':'' }}
      
        name="roles[]">
            {{ $name }}
      </label>
  @endforeach
  {!! $errors->first('roles','<span class="error">:message</span>') !!}<hr>

</div>

