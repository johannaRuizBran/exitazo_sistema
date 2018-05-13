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
<div class="container">
  <form class="form-horizontal" method="post" action="/crear/promocion" accept-charset="UTF-8">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <div class="form-group">
          <label for="inputnombre" class="control-label col-xs-4">Nombre de la promoción</label>
          <div class="col-xs-5">
              <input type="text" class="form-control" id="inputnombre" name="inputnombre" placeholder="Nombre de la promoción">
          </div>
      </div>
      <div class="form-group">
          <label for="inputCodBarras" class="control-label col-xs-4">Código de barras</label>
          <div class="col-xs-5">
              <input type="text" class="form-control" name="inputCodBarras" id="inputCodBarras" placeholder="Código de barras">
          </div>
      </div>
      <div class="form-group">
          <label for="inputCantidadInicial" class="control-label col-xs-4">Cantidad inicial</label>
          <div class="col-xs-5">
              <input type="text" name="inputCantidadInicial" class="form-control" id="inputCantidadInicial" placeholder="Cantidad inicial">
          </div>
      </div>
      <div class="form-group">
          <label for="inputCantidadFinal" class="control-label col-xs-4">Cantidad final</label>
          <div class="col-xs-5">
              <input type="text" name="inputCantidadFinal" class="form-control" id="inputCantidadFinal" placeholder="Cantidad final">
          </div>
      </div>
      <div class="form-group">
          <label for="inputPrecio" class="control-label col-xs-4">Precio unitario</label>
          <div class="col-xs-5">
              <input type="text" class="form-control" name="inputPrecio" id="inputPrecio" placeholder="Precio unitario">
          </div>
      </div>
      <div class="form-group">
          <div class="col-xs-offset-6 col-xs-10">
              <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-floppy-save"></span>&nbspGuardar</button>
          </div>
      </div>
  </form>
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
}
</script>
</html>