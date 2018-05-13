<!DOCTYPE html>
<html>
<head>
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
<a href="#" style="margin-left: 20%" class="btn btn-warning cboxElement">Devolver productos</a>
<a type="button" value="Add" onclick="findLowInInventoryCoincidencesInRows()" style="margin-left: 20%" class="btn btn-default cboxElement">Imprimir copia</a>
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
        <tr class="row-content">
            <td>14</td>
            <td>zapatos de cuero</td>
            <td>23450</td>
        </tr>
        <tr class="row-content">
            <td>1</td>
            <td>zapatos de cuero</td>
            <td>23450</td>
        </tr>
        <tr class="row-content">
            <td>4</td>
            <td>zapatos de cuero</td>
            <td>23450</td>
        </tr>
        <tr class="row-content">
            <td>7</td>
            <td>zapatos de cuero</td>
            <td>23450</td>
        </tr>
   </tbody>
  </table>
</div>
<div class="container">
    <div class="row">
        <h3>Total: 12345678</h3>
    </div>
    <div class="row">
        <h3>Pagó con: Crédito</h3>
    </div>
</div>
</body>
<script src="{{asset('plugins/sweetalert2/sweetalert2.min.js')}}"></script>
<script>
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