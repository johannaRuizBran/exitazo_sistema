<!DOCTYPE html>
<html>
<head>
  @include('partials.style')
</head>
<body>
@include('partials.nav')
<br>
<div class="container">
  <div class="row">
    <form class="form-horizontal">
      <div class="form-group" style="position: absolute;">
        <div class="col-xs-5 date">
            <div class="input-group input-append date" id="datePicker">
                <input type="text" class="form-control" name="date" />
                <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
            </div>
        </div>
    </div>
  </div>
      <!-- Include Bootstrap Datepicker -->
  <div class="form-group" style="margin-left: 55%;width: 100%">
      <div class="col-xs-5 date">
          <div class="input-group input-append date" id="datePicker2">
              <input type="text" class="form-control" name="date" />
              <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
          </div>
      </div>
  </div>  
  </form>

      <!-- Include Bootstrap Datepicker -->
    
</div>
<br>
<br>
<div class="row">
  <div style="float: left; margin-left: 7%">
    <h3>Entradas en efectivo</h3>
    <table class="rtable rtable--flip">
      <thead>
        <tr>
          <th>Entrada de dinero (cambio)</th>
          <th>Dinero inicial en caja</th>
          <th>Total</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>0</td>
          <td>{{$dineroInicialCaja[0]->dineroInicialCaja}}</td>
          <td>{{$dineroInicialCaja[0]->dineroInicialCaja}}</td>
        </tr>
      </tbody>
    </table>
  </div>
  <div style="float: left; margin-left: 7%">
    <h3>Dinero en caja</h3>
    <table class="rtable rtable--flip">
      <thead>
        <tr>
          <th>Ventas en efectivo</th>
          <th>Entradas</th>
          <th>Pago a proveedores</th>
          <th>Total</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>{{$pagosContado[0]->monto}}</td>
          <td>73000</td>
          <td>569000</td>
          <td>8252</td>
        </tr>
      </tbody>
    </table>
  </div>
  <div style="float: left; margin-left: 7%">
    <h3>Pagos de contado</h3>
    <table class="rtable rtable--flip">
      <thead>
        <tr>
          <th>Efectivo</th>
          <th>Total</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>579000</td>
          <td>579000</td>
        </tr>
      </tbody>
    </table>
  </div>
  <div style="float: left; margin-left: 7%">
    <h3>Ventas por departamento</h3>
    <table class="rtable rtable--flip" >
      <thead>
        <tr>
          <th>Ventas en efectivo</th>
          <th>Entradas</th>
          <th>Pago a proveedores</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>579000</td>
          <td>73000</td>
          <td>569000</td>
        </tr>
      </tbody>
    </table>
  </div>
  
</div> 
<div class="container">
  <div style="float: left; margin-left: 7%">
    <h3>Pago de clientes</h3>
    <table class="rtable rtable--flip">
      <thead>
        <tr>
          <th>Carlos</th>
          <th>Bryan</th>
          <th>Total</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>579000</td>
          <td>73000</td>
          <td>569000</td>
        </tr>
      </tbody>
    </table>
  </div>
  <div style="float: left; margin-left: 7%">
    <h3>Pago a proveedores</h3>
    <table class="rtable rtable--flip">
      <thead>
        <tr>
          <th>Pedro</th>
          <th>Juan</th>
          <th>Total</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>579000</td>
          <td>73000</td>
          <td>569000</td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
<div class="container">
  <h3>Ventas totales: <h4>123000</h4> </h3>
  <h3>Ganancia del dia: <h4>78000</h4></h3>
</div> 
</body>
<script src="{{asset('plugins/sweetalert2/sweetalert2.min.js')}}"></script>
<script>
  window.onload = function() {loadPage()};
  function loadPage()
  {
    document.getElementById("navBrand").style.color = "white";
    document.getElementById("navEnds").style.color = "white";
  }
</script>
<script>
$(document).ready(function() {
    $('#datePicker')
        .datepicker({
            format: 'dd/mm/yyyy'
        })
        .on('changeDate', function(e) {
            // Revalidate the date field
            $('#eventForm').formValidation('revalidateField', 'date');
        });
    $('#datePicker2')
        .datepicker({
            format: 'dd/mm/yyyy'
        })
        .on('changeDate', function(e) {
            // Revalidate the date field
            $('#eventForm').formValidation('revalidateField', 'date');
        });
    $('#eventForm').formValidation({
        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            name: {
                validators: {
                    notEmpty: {
                        message: 'The name is required'
                    }
                }
            },
            date: {
                validators: {
                    notEmpty: {
                        message: 'The date is required'
                    },
                    date: {
                        format: 'MM/DD/YYYY',
                        message: 'The date is not a valid'
                    }
                }
            }
        }
    });
});
</script>
</html>