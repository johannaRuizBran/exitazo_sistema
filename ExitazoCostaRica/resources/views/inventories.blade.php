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
@if (Auth::user()->type === "Administrador")
<a href="/crearProducto" style="margin-left: 20%" class="btn btn-info cboxElement">Agregar Producto</a>
@endif
<a type="button" value="Add" onclick="findLowInInventoryCoincidencesInRows()" style="margin-left: 20%" class="btn btn-default cboxElement">Productos bajos en inventario</a>
<a type="button" value="Add" onclick="inventoryReport()" style="margin-left: 3%" class="btn btn-default cboxElement">Reporte de inventario</a>
<br>
<br>
@include('partials.filterSearchBar')
<br>
<div class="container">  
  <table id="contentTable" class="table table-striped">
   <thead>      
      <tr class="row-name">
         <th>Código de barras</th>
         <th>Descripción</th>
         <th>Precio costo</th>
         <th>Precio venta</th>
         <th>Precio mayoreo</th>
         <th>Departamento</th>
         <th>Cantidad actual</th>
         <th>Mínimo</th>
      </tr>
   </thead>   
   <tbody>
      @foreach($productos as $productos)
        <tr class="row-content">
         <td>{{$productos->codigoProducto}}</td>
         <td>{{$productos->descripcion}}</td>
         <td>{{$productos->precioCosto}}</td>
         <td>{{$productos->precioVenta}}</td>
         <td>{{$productos->precioMayoreo}}</td>
         <td>{{$productos->nombreDepartamento}}</td>
         <td>{{$productos->cantidadDeProduct}}</td>
         <td>{{$productos->cantMinimaProd}}</td>
         @if (Auth::user()->type === "Administrador")
         <td>
            <a title="Eliminar" class="btn btn-danger" href="/eliminar/producto/{{$productos->codigoProducto}}" aria-label="Settings">
              <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
            </a>
            &nbsp 
            <a title="Modificar" class="btn btn-warning" href="/editar/producto/{{$productos->codigoProducto}}" aria-label="Settings">
              <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
            </a> 
          </td>
          @endif
        </tr>        
      @endforeach      
   </tbody>
  </table>
</div>
</body>
<script>
  window.onload = function() {loadPage()};
  /*function getUrl() {
    var URLactual = window.location;
    return URLactual;
  }*/
  function checkIfInventoryOrProductLowInInventory() {
    document.getElementById("buttonProducts").style.background = "#ccc"; 
    /*if (getUrl() == "http://localhost:8000/productoBajoEnInventario") {
      document.getElementById("buttonProductLowInInventory").style.background = "#ccc"; 
      findLowInInventoryCoincidencesInRows();
    }
    else {
      document.getElementById("buttonProducts").style.background = "#ccc"; 
    }*/
  }
  function loadPage() {
    document.getElementById("navBrand").style.color = "white";
    document.getElementById("navInventories").style.color = "white";
    checkIfInventoryOrProductLowInInventory(); 
    document.getElementById("filterSearchInput").placeholder = "Código de barras / Descripción / Departamento";
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
      tdDepartment = tr[i].getElementsByTagName("td")[5];
      if (tdCode && tdDescription) {
        if (tdCode.innerHTML.toUpperCase().indexOf(filter) > -1 || tdDescription.innerHTML.toUpperCase().indexOf(filter) > -1 || tdDepartment.innerHTML.toUpperCase().indexOf(filter) > -1) {
          tr[i].style.display = "";
        } else {
          tr[i].style.display = "none";
        }
      }       
    }
  }

  function findLowInInventoryCoincidencesInRows() {
    var filter, table, tr, tdCode, tdDescription, tdDepartment, i;
    filter = 0;
    table = document.getElementById("contentTable");
    tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
      tdQuantity = tr[i].getElementsByTagName("td")[6];
      if (tdQuantity) {
        if (tdQuantity.innerHTML == filter) {
          tr[i].style.display = "";
        } else {
          tr[i].style.display = "none";
        }
      }       
    }
  }

  function inventoryReport() {
    var table, tr, i, tdCost, totalCost, tdProductsQuantity, totalQuantity;
    totalCost = 0;
    totalQuantity = 0;
    table = document.getElementById("contentTable");
    tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
      tdCost = tr[i].getElementsByTagName("td")[2];
      tdProductsQuantity = tr[i].getElementsByTagName("td")[6];
      if (tdCost && tdProductsQuantity) {
        totalCost += Number(tdCost.innerHTML);
        totalQuantity += Number(tdProductsQuantity.innerHTML);
      }
    }
    swal('Costo del inventario' + ': ' + totalCost + ' \n ' + 'Cantidad de productos' + ': ' + totalQuantity);
  }
</script>
</html>