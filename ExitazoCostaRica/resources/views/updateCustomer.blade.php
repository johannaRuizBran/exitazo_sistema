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
<div class="container">
  <form class="form-horizontal" method="post" action="/modificar/cliente/{{$user->numeroPersona}}" accept-charset="UTF-8">
  <input type="hidden" name="_token" value="{{ csrf_token() }}">  
      <div class="form-group">
          <label for="inputNombre" class="control-label col-xs-2">Nombre completo</label>
          <div class="col-xs-5">
              <input type="text" name="inputNombre" class="form-control" id="inputNombre" placeholder="Nombre completo" value="{{$user->nombrePersona}}" >
          </div>
      </div>
      <div class="form-group">
          <label for="inputDireccion" class="control-label col-xs-2">Dirección</label>
          <div class="col-xs-5">
              <input type="text" name="inputDireccion" class="form-control" id="inputDireccion" placeholder="Dirección"  value="{{$user->direccion}}" >
          </div>
      </div>
        <div class="form-group">
          <label for="inputTelefono" class="control-label col-xs-2">Teléfono</label>
          <div class="col-xs-5">
              <input type="text" name="inputTelefono" class="form-control" id="inputTelefono" placeholder="Teléfono"  value="{{$user->telefono}}" >
          </div>
      </div>
      <div class="form-group">
          <label for="inputLimiteCredito" class="control-label col-xs-2">Límite de crédito</label>
          <div class="col-xs-5">
              <input type="text" name="inputLimiteCredito" class="form-control" id="inputLimiteCredito" placeholder="Límite de credito"  value="{{$user->limiteDeCredito}}" >
          </div>
      </div>
      
      <div class="form-group">
          <div class="col-xs-offset-2 col-xs-10">
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
  document.getElementById("navCustomers").style.color = "white";
  document.getElementById("buttonCustomers").style.background = "#ccc";
}
</script>
</html>