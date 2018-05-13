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
<div style="margin-left: 5%">
  <h2>Costo del inventario: &nbsp ₡ 1010233</h2>
  <h2>Cantidad de productos en el inventario:&nbsp 1234567</h2>
  <br>
  <a class="btn btn-default cboxElement">Imprimir</a>
</div>
</body>
<script src="{{asset('plugins/sweetalert2/sweetalert2.min.js')}}"></script>
<script>
  window.onload = function() {loadPage()};
  function loadPage()
  {
    document.getElementById("navBrand").style.color = "white";
    document.getElementById("navInventories").style.color = "white";
    document.getElementById("buttonIntentoryReport").style.background = "#ccc";
  }
</script>
</html>