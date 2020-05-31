<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
    <link rel="stylesheet" href="/css/app.css">
    <script type="text/javascript" src="{{asset('js/app.js')}}"></script>
</head>
<body>

    <header>
        <nav class="navbar navbar-expand-lg navbar-dark  ">
            <div class="container-fluid">
                 <!--Icono de la pagina-->
                 <a class="navbar-brand" href="#">Icono</a>
     
                 <button class="navbar-toggler" type="button" data-toggle='collapse' data-target='#navbar' aria-controls='navbar' aria-expanded="false" aria-label='Menu de Navegacion'>
                     <span class="navbar-toggler-icon"></span>
                 </button>
     
                 <div class="collapse navbar-collapse" id="navbar">
                     <!--Enlaces de navegacion-->
                     <ul class="navbar-nav mr-auto ">
                        <li class="nav-item pt-4 pr-3">
                            <a  class="{{ request()->routeIs('home')? 'active':'' }}" href="{{ route('home') }}">Inicio</a>
                        </li>
            
                        <li class="nav-item pt-4 pr-3">
                            <a class="{{ request()->routeIs('saludo')? 'active':'' }}" href="{{ route('saludo','Jorge') }}">Saludos</a>
                        </li>
            
                        <li class="nav-item pt-4 pr-3">
                            <a class="{{ request()->routeIs('messages.create')? 'active':'' }}" href="{{ route('messages.create') }}">Contactos</a>
                        </li>
                        @guest
                        <li class="nav-item pt-4 pr-3">
                            <a  href="/login">Login</a>
                        </li>
                        @else

                        <li class="nav-item pt-4 pr-3">
                            <a class="{{ request()->routeIs('messages.index')? 'active':'' }}" href="{{ route('messages.index') }}">Mensajes</a>
                        </li>

                        @if(auth()->user()->hasRole(['admin','estudiante']))
                        <li class="nav-item pt-4 pr-3">
                            <a class="{{ request()->routeIs('usuarios.index')? 'active':'' }}" href="{{ route('usuarios.index') }}">Usuarios</a>
                        </li>
                        @endif
                          <!--Submenu-->
                          <li class="nav-item dropdown p-3">
                            <a href="#" action="/logout" class="nav-link dropdown-toggle" id="menu-categorias" data-toggle='dropdown' aria-haspopup="true" aria-expanded="false">
                                {{ auth()->user()->name }}
                            </a>
                            <div class="dropdown-menu " aria-labelledby="menu-categorias">
                                <ul>
                                    <li><a class="submenu-item" href="/usuarios/{{ auth()->id() }}/edit">Mi cuenta</a></li>

                                    <li> <a class="submenu-item" href="#"onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();"
                                        >Cerrar Sesion</a></li>
                                </ul>
                            </div>
                          </li>
                        @endguest
                     </ul>
                     <form id="logout-form" action="/logout" method="POST" style="display: none;">
                        @csrf
                    </form>
                 </div>
     
            </div>
         </nav>
       
    </header>

    @yield('contenido')
    <footer>Copyright {{ date('Y') }}</footer>
    
</body>
</html>