<!DOCTYPE html>
<html>
<head>
  <title></title>
  @include('partials.style')
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.min.css" />
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css" />
  <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script>
</head>
<body>
@include('partials.nav')
<br>
@include('partials.sellingsMenu')
<br>
<form class="form-horizontal" method="post" action="/devolder/producto/" accept-charset="UTF-8">
  <input type="hidden" name="_token" value="{{ csrf_token() }}">
  <input type="hidden" name="lista" id="lista" value="{{$registrosHistorial}}">
  <input type="hidden" name="fecha" id="fecha" value="">
  <button style="margin-left: 20%" type="submit" class="btn btn-warning cboxElement" onclick="fechainput()">Devolver productos</button>
  <a type="button" value="Add" onclick="findLowInInventoryCoincidencesInRows()" style="margin-left: 20%" class="btn btn-default cboxElement">Imprimir copia</a>
</form>

<br>
<br>    
<div class="container">
  <table id="contentTable" class="table table-striped">
   <thead>
      <tr class="row-name">
         <th>Cantidad</th>
         <th>Descripción</th>
         <th>Importe</th>
      </tr>
   </thead>   
   <tbody>
      @foreach($registrosHistorial as $registrosHistorial)
        <tr class="row-content">
            <td>{{$registrosHistorial->cantidad}}</td>
            <td>{{$registrosHistorial->descripcion}}</td>
            <td>{{$registrosHistorial->precioVenta * $registrosHistorial->cantidad}}</td>
        </tr>
      @endforeach        
   </tbody>
  </table>
</div>
<div class="container">
    <div class="row">
        <h3>Total: {{$total}}</h3>
    </div>
    <div class="row">
        <h3>Pagó con: {{$tipoPago}}</h3>
    </div>
</div>
</body>
<script src="{{asset('plugins/sweetalert2/sweetalert2.min.js')}}"></script>
<script>
function fechainput(){
  var dt = new Date();
  var month = dt.getMonth()+1;
  var day = dt.getDate();
  var year = dt.getFullYear();
  var fecha= year + '-' + month + '-' + day;  
  document.getElementById("fecha").value= fecha;
}

window.onload = function() {myFunction()};
function myFunction()
{
  document.getElementById("navBrand").style.color = "white";
  document.getElementById("navSellings").style.color = "white";
  document.getElementById("buttonBill").style.background = "#ccc";
  document.getElementById("buttonDetail").style.background = "#ccc"; 
  document.getElementById("filterSearchInput").placeholder = "Número de factura / Cantidad de artículos";
}
document.addEventListener("keydown", keyDownTextField, false);
function keyDownTextField(e) {
var keyCode = e.keyCode;
  //F10
  if(keyCode==121) {
  alert("You hit the F10.");
  } 
  //F12
  else if(keyCode==123) {
    alert("You hit the F12.");
  }
  //F11
  else if(keyCode==122) {
    alert("You hit the F11.");
  }
  //F8
  else if(keyCode==119) {
    window.location.href = "/salidas";
  }
  //F7
  else if(keyCode==118) {
    window.location.href = "/entradas";
  }
}
</script>
</html>