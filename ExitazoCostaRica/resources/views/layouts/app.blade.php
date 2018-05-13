<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>El Exitazo Costa Rica</title>
    <link href="{{asset('images/sombrero.ico')}}"" rel="icon">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/css/base.css') }}" rel="stylesheet"> 

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel" style="background-color: #000">
            <div class="container">
                <a style="color: #fff" class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'El Exitazo') }}
                </a>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li><a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a></li>
                        @else
                            <li><a id="navSellings" href="/ventas">Ventas</a></li>
                            <li><a id="navCustomers" href="/clientes">Clientes</a></li>
                            <li><a id="navInventories" href="/inventario">Inventarios</a></li>
                            <li><a id="navEnds" href="/corte">Cortes</a></li>
                            <li><a id="navConfig" href="/config">Configuración</a></li>
                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    {{ Auth::user()->name }} ({{ __('Logout') }})
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
