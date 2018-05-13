<!DOCTYPE html>
<html>
<head>
  @include('partials.style')
</head>
<body>
@include('partials.nav')
<br>
@include('partials.sellingsMenu')
<br>
<a href="/crearSalida" style="margin-left: 20%" class="btn btn-info cboxElement">Agregar salida</a>
<br>
<br>
<div class="container">
  <table class="table table-striped">
   <thead>
      <tr class="row-name">
         <th>Motivo</th>
         <th>Monto de dinero</th>
      </tr>
   </thead>   
   <tbody>
      @foreach($salidas as $salidas)
        <tr class="row-content">
           <td>{{$salidas->motivo}}</td>
           <td>{{$salidas->montoDinero}}</td>
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
  document.getElementById("navSellings").style.color = "white";
  document.getElementById("buttonOutComing").style.background = "#ccc";
}
</script>
</html>