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
@include('partials.inventoriesMenu')
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
  <div class="form-group" style="margin-top: 5%;">
      <select style="width: 39%;margin-left: 3%;" class="input form-control pdi-spacing-02" id="field1" name="prof1">
          <option>Seleccione el departamento...</option>
          <option>Zapatos</option>
          <option>Bolsos</option>
          <option>Cuero</option>
          <option>Fajas</option>
      </select>
  </div>
  <div class="form-group">
      <select style="width: 39%;margin-left: 3%;" class="input form-control pdi-spacing-02" id="field1" name="prof1">
          <option>Seleccione el cajero...</option>
          <option>Bryan</option>
          <option>Pedro</option>
          <option>Bran</option>
          <option>Labs</option>
      </select>
  </div>
  </form>

      <!-- Include Bootstrap Datepicker -->
    
</div>
<br>
<div class="container">
  <table class="table table-striped">
   <thead>
      <tr class="row-name">
         <th>Hora</th>
         <th>Descripción del producto</th>
         <th>Había</th>
         <th>Tipo</th>
         <th>Cantidad</th>
         <th>Cajero</th>
         <th>Departamento</th>
      </tr>
   </thead>   
   <tbody>
      <tr class="row-content">
         <td>12:00</td>
         <td>Zapatos de cuero</td>
         <td>12</td>
         <td>Salida</td>
         <td>23450</td>
         <td>Bryan</td>
         <td>Zapatos</td>
      </tr>
      <tr class="row-content">
         <td>12:00</td>
         <td>Zapatos de cuero</td>
         <td>12</td>
         <td>Salida</td>
         <td>23450</td>
         <td>Bryan</td>
         <td>Zapatos</td>
      </tr>
      <tr class="row-content">
         <td>12:00</td>
         <td>Zapatos de cuero</td>
         <td>12</td>
         <td>Salida</td>
         <td>23450</td>
         <td>Bryan</td>
         <td>Zapatos</td>
      </tr>
      <tr class="row-content">
         <td>12:00</td>
         <td>Zapatos de cuero</td>
         <td>12</td>
         <td>Salida</td>
         <td>23450</td>
         <td>Bryan</td>
         <td>Zapatos</td>
      </tr>
   </tbody>
  </table>
</div>
</body>
<script src="{{asset('plugins/sweetalert2/sweetalert2.min.js')}}"></script>
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
<script>
window.onload = function() {myFunction()};
function myFunction()
{
  document.getElementById("navBrand").style.color = "white";
  document.getElementById("navInventories").style.color = "white";
  document.getElementById("buttonMovementsReport").style.background = "#ccc";
}
</script>
</html>