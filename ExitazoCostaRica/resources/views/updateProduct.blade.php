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
  <form class="form-horizontal" method="post" action="/modificar/producto/{{$product->codigoProducto}}" accept-charset="UTF-8">
    <input type="hidden" name="_token" value="{{ csrf_token() }}"> 
      <div class="form-group">
          <label for="inputCodigoBarras" class="control-label col-xs-2">Código de barras</label>
          <div class="col-xs-5">
              <input type="text" class="form-control" name="inputCodigoBarras" id="inputCodigoBarras"  value="{{$product->codigoProducto}}" placeholder="Nombre completo">
          </div>
      </div>
      <div class="form-group">
          <label for="inputDescripcion" class="control-label col-xs-2">Descripción</label>
          <div class="col-xs-5">
              <input type="text" class="form-control" name="inputDescripcion" id="inputDescripcion" placeholder="Descripción"  value="{{$product->descripcion}}" >
          </div>
      </div>
        <div class="form-group">
          <label for="inputPrecioCosto" class="control-label col-xs-2">Precio de costo</label>
          <div class="col-xs-5">
              <input type="text" class="form-control" name="inputPrecioCosto" id="inputPrecioCosto" placeholder="Precio de costo"  value="{{$product->precioCosto}}">
          </div>
      </div>
      <div class="form-group">
          <label for="inputPrecioVenta" class="control-label col-xs-2">Precio de venta</label>
          <div class="col-xs-5">
              <input type="text" class="form-control" name="inputPrecioVenta" id="inputPrecioVenta" placeholder="Precio de venta"  value="{{$product->precioVenta}}">
          </div>
      </div>
      <div class="form-group">
          <label for="inputPrecioMayoreo" class="control-label col-xs-2">Precio de mayoreo</label>
          <div class="col-xs-5">
              <input type="text" class="form-control" name="inputPrecioMayoreo" id="inputPrecioMayoreo" placeholder="Precio de mayoreo"  value="{{$product->precioMayoreo}}">
          </div>
      </div>
      <div class="form-group">
          <label for="inputNombreDepartamento" class="control-label col-xs-2">Departamento</label>
          <select style="width: 39%;margin-left: 18%" class="input form-control pdi-spacing-02" id="inputNombreDepartamento" name="inputNombreDepartamento">
              <option>Seleccione el departamento...</option>
              <option value="zapatos">Zapatos</option>
              <option value="bolsos">Bolsos</option>
              <option value="cuero">Cuero</option>
              <option value="fajas">Fajas</option>
          </select>
      </div>
      <div class="form-group">
          <label for="inputCantidadDeProduct" class="control-label col-xs-2">Cantidad actual</label>
          <div class="col-xs-5">
              <input type="text" class="form-control" name="inputCantidadDeProduct" id="inputCantidadDeProduct" placeholder="Cantidad actual"  value="{{$product->cantidadDeProduct}}">
          </div>
      </div>
      <div class="form-group">
          <label for="inputCantMinimaProd" class="control-label col-xs-2">Minimo</label>
          <div class="col-xs-5">
              <input type="text" class="form-control" name="inputCantMinimaProd" id="inputCantMinimaProd" placeholder="Minimo" value="{{$product->cantMinimaProd}}"  disabled>
          </div>
      </div>
      <div class="form-group">
          <input id="department" value="{{$product->nombreDepartamento}}" hidden></input>
          <div class="col-xs-offset-2 col-xs-10">
              <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-floppy-save"></span>&nbsp Guardar</button>
          </div>
      </div>
  </form>
</div>

</body>
<script src="{{asset('plugins/sweetalert2/sweetalert2.min.js')}}"></script>
<script>
  window.onload = function() {loadPage()};
  function loadPage()
  {
    document.getElementById("navBrand").style.color = "white";
    document.getElementById("navInventories").style.color = "white";
    document.getElementById("buttonProducts").style.background = "#ccc";  
    var value = document.getElementById("department").value ;
    selectOptionOnDropDown(value);
  }
  function selectOptionOnDropDown(value) {
    console.log(value);
    document.getElementById('inputNombreDepartamento').value=value;
  }
</script>
</html>