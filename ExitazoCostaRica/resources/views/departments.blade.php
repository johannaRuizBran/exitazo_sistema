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
<a href="/crearDepartamento" style="margin-left: 20%" class="btn btn-info cboxElement">Agregar departamento</a>
@endif
<br>
<br>
@include('partials.filterSearchBar')
<br>
<div class="container">
  <table id="contentTable" class="table table-striped" style="width: 35%">
   <thead>
      <tr class="row-name">
         <th>Departamento</th>
      </tr>
   </thead>   
   <tbody>
    @foreach($departamentos as $departamentos)
      <tr class="row-content">
         <td>{{$departamentos->nombreDepartamento}}</td>
         @if (Auth::user()->type === "Administrador")
         <td>
            <a title="Eliminar" class="btn btn-danger" href="/eliminar/departamento/{{$departamentos->nombreDepartamento}}" aria-label="Settings">
              <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
            </a>
          </td>
          @endif
      </tr>      
    @endforeach
   </tbody>
  </table>
</div>
</body>
<script src="{{asset('plugins/sweetalert2/sweetalert2.min.js')}}"></script>
<script>
  window.onload = function() {loadPage()};
  function loadPage()
  {
    document.getElementById("navBrand").style.color = "white";
    document.getElementById("navInventories").style.color = "white";
    document.getElementById("buttonDepartments").style.background = "#ccc";    
    document.getElementById("filterSearchInput").placeholder = "Departamento";
  }
  function findCoincidencesInRows() {
    var input, filter, table, tr, td, i;
    input = document.getElementById("filterSearchInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("contentTable");
    tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
      td = tr[i].getElementsByTagName("td")[0];
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

