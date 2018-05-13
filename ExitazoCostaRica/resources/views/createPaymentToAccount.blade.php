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
  <form class="form-horizontal" method="post" action="/crear/abono" accept-charset="UTF-8"> 
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" name="persona" value="{{$numeroPersona}}">
      <div class="form-group">
          <label for="inputFechaAbono" class="control-label col-xs-4">Fecha del abono</label>
          <div class="col-xs-5">
              <input type="text" class="form-control" name="inputFechaAbono" id="inputFechaAbono" placeholder="AAAA-MM-DD">
          </div>
      </div>
      <div class="form-group">
          <label for="inputAbono" class="control-label col-xs-4">Monto del abono</label>
          <div class="col-xs-5">
              <input type="text" class="form-control" name="inputAbono" id="inputAbono" placeholder="Monto del abono">
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
    document.getElementById("navCustomers").style.color = "white";
    document.getElementById("buttonCustomers").style.background = "#ccc";
}
</script>
</html>