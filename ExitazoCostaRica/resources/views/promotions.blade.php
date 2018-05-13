<!DOCTYPE html>
<html>
<head>
  @include('partials.style')
</head>
<body>
@include('partials.nav')
<br>
@include('partials.inventoriesMenu')
<br>
<a href="/crearPromocion" style="margin-left: 20%" class="btn btn-info cboxElement">Agregar promoción</a>
<br>
<br>
@include('partials.filterSearchBar')
<br>
<div class="container">
  <table id="contentTable" class="table table-striped">
   <thead>
      <tr class="row-name">
         <th>Nombre de la promocion</th>
         <th>Código del producto</th>
         <th>Desde</th>
         <th>Hasta</th>
         <th>Precio promoción</th>
      </tr>
   </thead>   
   <tbody>
    @foreach($promociones as $promociones)
      <tr class="row-content">
         <td>{{$promociones->nombrePromocion}}</td>
         <td>{{$promociones->codigoProducto}}</td>
         <td>{{$promociones->cantidadProdMinimo}}</td>
         <td>{{$promociones->cantidadProdMax}}</td>
         <td>{{$promociones->precioUnit}}</td>
         <td>
            <a title="Eliminar" class="btn btn-danger" href="/eliminar/promocion/{{$promociones->nombrePromocion}}" aria-label="Settings">
              <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
            </a>
          </td>
      </tr>    
    @endforeach  
   </tbody>
  </table>
</div>
</body>
<script src="{{asset('plugins/sweetalert2/sweetalert2.min.js')}}"></script>
<script>
window.onload = function() {myFunction()};
function myFunction()
{
  document.getElementById("navBrand").style.color = "white";
  document.getElementById("navInventories").style.color = "white";
  document.getElementById("buttonPromotions").style.background = "#ccc";
  document.getElementById("filterSearchInput").placeholder = "Nombre de la promoción / Código del producto / Precio promoción";
}
function findCoincidencesInRows() {
  var input, filter, table, tr, tdCode, tdDescription, tdDepartment, i;
  input = document.getElementById("filterSearchInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("contentTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    tdCode = tr[i].getElementsByTagName("td")[0];
    tdDescription = tr[i].getElementsByTagName("td")[1];
    tdDepartment = tr[i].getElementsByTagName("td")[4];
    if (tdCode && tdDescription && tdDepartment) {
      if (tdCode.innerHTML.toUpperCase().indexOf(filter) > -1 || tdDescription.innerHTML.toUpperCase().indexOf(filter) > -1 || tdDepartment.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }         
  }
}
</script>
</html>