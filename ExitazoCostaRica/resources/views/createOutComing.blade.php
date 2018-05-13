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
<div class="container">	
  <form class="form-horizontal" method="post" action="/crear/salida" accept-charset="UTF-8"> 
    <input type="hidden" name="_token" value="{{ csrf_token() }}">  
      <div class="form-group">
          <label for="inputMotivo" class="control-label col-xs-4">Motivo</label>
          <div class="col-xs-5">
              <input type="text" class="form-control" name="inputMotivo" id="inputMotivo" placeholder="Motivo">
          </div>
      </div>
      <div class="form-group">
          <label for="inputMonto" class="control-label col-xs-4">Monto de dinero</label>
          <div class="col-xs-5">
              <input type="text" class="form-control" name="inputMonto"  id="inputMonto" placeholder="Monto de dinero">
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
  document.getElementById("navSellings").style.color = "white";
  document.getElementById("buttonOutComing").style.background = "#ccc";
}
</script>
</html>