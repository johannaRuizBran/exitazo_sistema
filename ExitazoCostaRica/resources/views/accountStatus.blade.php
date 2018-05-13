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
<br>
<div class="container">
    <div class="row form-horizontal">
        <div class="form-group">
            <label for="inputEmail" class="control-label col-xs-2">Nombre completo</label>
            <div class="col-xs-5">
                <input type="text" class="form-control" id="inputEmail" placeholder="Nombre completo" disabled value="{{$user->nombrePersona}}">
            </div>
        </div>
        <div class="form-group">
            <label for="inputPassword" class="control-label col-xs-2">Dirección</label>
            <div class="col-xs-5">
                <input type="text" class="form-control" id="inputPassword" placeholder="Dirección" value="{{$user->direccion}}" disabled>
            </div>
        </div>
            <div class="form-group">
            <label for="inputEmail" class="control-label col-xs-2">Teléfono</label>
            <div class="col-xs-5">
                <input type="email" class="form-control" id="inputEmail" placeholder="Teléfono" value="{{$user->telefono}}" disabled>
            </div>
        </div>
        <div class="form-group">
            <label for="inputPassword" class="control-label col-xs-2">Límite de credito</label>
            <div class="col-xs-5">
                <input class="form-control" id="inputPassword" placeholder="Límite de credito" value="{{$user->limiteDeCredito}}" disabled>
            </div>
        </div>
        <div class="form-group">
                <label for="inputPassword" class="control-label col-xs-2">Saldo actual</label>
                <div class="col-xs-5">
                    <input class="form-control" id="inputPassword" placeholder="Saldo actual" value="{{$user->saldoActual}}" disabled>
                </div>
            </div>
    </div>
</div>
<br>
<a href="/crearAbono/{{$user->numeroPersona}}" style="margin-left: 20%" class="btn btn-info cboxElement">Agregar abono</a>
<br>
<br>
<div class="container">
  <table id="contentTable" class="table table-striped">
   <thead>
      <tr class="row-name">
         <th>Número de factura</th>
         <th>Fecha del abono</th>
         <th>Monto del abono</th>
      </tr>
   </thead>   
   <tbody>
    @foreach($abonos as $abonos)
      <tr class="row-content">
         <td>{{$abonos->id}}</td>
         <td>{{$abonos->fechaAbono}}</td>
         <td>{{$abonos->monto}}</td>
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