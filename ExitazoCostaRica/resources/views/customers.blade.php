<!DOCTYPE html>
<html>
<head>
  @include('partials.style')
</head>
<body>
@include('partials.nav')

<br>
@include('partials.customersMenu')
<br>
@if (Auth::user()->type === "Administrador")
<a href="/crearCliente" style="margin-left: 20%" class="btn btn-info cboxElement">
Agregar cliente</a>
@endif
<br>
<br>
@include('partials.filterSearchBar')
<br>
<div class="container">  
  <table id="contentTable" class="table table-striped">
   <thead>
      <tr class="row-name">
         <th>Número</th>
         <th>Nombre</th>
         <th>Dirección</th>
         <th>Teléfono</th>
         <th>Límite de crédito</th>
         <th>Saldo actual</th>
      </tr>
   </thead>   
   <tbody>    
      @foreach($clientes as $clientes)        
        <tr class="row-content">
           <td>{{$clientes->numeroPersona}}</td>
           <td>{{$clientes->nombrePersona}}</td>
           <td>{{$clientes->direccion}}</td>
           <td>{{$clientes->telefono}}</td>
           <td>{{$clientes->limiteDeCredito}}</td>
           <td>{{$clientes->saldoActual}}</td>
           <td>
              @if (Auth::user()->type === "Administrador")
                <a title="Eliminar" class="btn btn-danger" href="/eliminar/cliente/{{$clientes->numeroPersona}}" aria-label="Settings">
                  <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                </a>
                &nbsp 
                <a title="Editar" id="edit" href="/editar/cliente/{{$clientes->numeroPersona}}" class="btn btn-warning" aria-label="Settings">
                  <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                </a> 
              @endif
              &nbsp 
              <a title="Estado de cuenta" class="btn btn-primary" href="/estadoDeCuenta/{{$clientes->numeroPersona}}" aria-label="Settings">
                <span class="glyphicon glyphicon-credit-card" aria-hidden="true"></span>
              </a> 
           </td>
        </tr>
      @endforeach      
   </tbody>
  </table>
</div>
</body>
<script>
window.onload = function() {loadSite()};
function loadSite()
{
  document.getElementById("navBrand").style.color = "white";
  document.getElementById("navCustomers").style.color = "white";
  document.getElementById("buttonCustomers").style.background = "#ccc";
  document.getElementById("filterSearchInput").placeholder = "Nombre del cliente";
}
function findCoincidencesInRows() {
  var input, filter, table, tr, td, i;
  input = document.getElementById("filterSearchInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("contentTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    } 
  }
}
</script>
</html>