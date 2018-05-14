<!DOCTYPE html>
<html>
<head>
  @include('partials.style')
  <script src="{{asset('js/globales.js')}}"></script>
</head>
<body>
@include('partials.nav')

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
              <a title="Seleccionar" class="btn btn-primary" onclick="cambiarUsuario({{$clientes->numeroPersona}})" aria-label="Settings">
                <span class="glyphicon glyphicon-send"></span>
              </a>
           </td>
        </tr>     
      @endforeach      
   </tbody>
  </table>
</div>
</body>

<script>
function cambiarUsuario(valorPersona){
  alert(cliente_id);
  cliente_id= valorPersona;
  alert("Desde clientes vista"+cliente_id);
  window.location.href="/ventas";
}

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