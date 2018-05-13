@if (Route::has('login'))
<nav class="navbar navbar-inverse">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-3">
        <span class="sr-only">Toggle navigation</span>
      </button>
      <a class="navbar-brand text-white" id="navBrand" href="#">El Exitazo</a>
    </div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="navbar-collapse-3">
      <ul class="nav navbar-nav navbar-right">
        <li><a id="navSellings" href="/ventas">Ventas</a></li>
        <li><a id="navCustomers" href="/clientes">Clientes</a></li>
        <li><a id="navInventories" href="/inventario">Inventarios</a></li>
        <li><a id="navEnds" href="/corte">Cortes</a></li>
        <li><a id="navConfig" href="/config">Configuración</a></li>
        <li><a class="dropdown-item" href="{{ route('logout') }}"
           onclick="event.preventDefault();
                         document.getElementById('logout-form').submit();">
            {{ Auth::user()->name }} ({{ __('Logout') }})
        </a>
      </li>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container -->
</nav><!-- /.navbar -->
@endif
