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
@include('partials.filterSearchBar')
<br>    
<div class="container">
  <table id="contentTable" class="table table-striped">
   <thead>
      <tr class="row-name">
         <th>Número de factura</th>
         <th>Cantidad de artículos</th>
         <th>Hora</th>
         <th>Total</th>
      </tr>
   </thead>   
   <tbody>
        <tr class="row-content">
            <td>1</td>
            <td>45</td>
            <td>12:12</td>
            <td>23450</td>
            <td>
                <a href="/tiqueteVentasDevoluciones" title="Información" class="btn btn-info" aria-label="Settings">
                    <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>
                </a>
                <a title="Eliminar" class="btn btn-danger" aria-label="Settings">
                <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                </a>
            </td>
        </tr>
        <tr class="row-content">
            <td>2</td>
            <td>689</td>
            <td>12:12</td>
            <td>23450</td>
            <td>
                <a href="/tiqueteVentasDevoluciones" title="Información" class="btn btn-info" aria-label="Settings">
                    <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>
                </a>
                <a title="Eliminar" class="btn btn-danger" aria-label="Settings">
                <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                </a>
            </td>
        </tr>
        <tr class="row-content">
            <td>3</td>
            <td>16</td>
            <td>12:12</td>
            <td>23450</td>
            <td>
                <a href="/tiqueteVentasDevoluciones" title="Información" class="btn btn-info" aria-label="Settings">
                    <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>
                </a>
                <a title="Eliminar" class="btn btn-danger" aria-label="Settings">
                <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                </a>
            </td>
        </tr>
        <tr class="row-content">
            <td>4</td>
            <td>25</td>
            <td>12:12</td>
            <td>23450</td>
            <td>
                <a href="/tiqueteVentasDevoluciones" title="Información" class="btn btn-info" aria-label="Settings">
                    <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>
                </a>
                <a title="Eliminar" class="btn btn-danger" aria-label="Settings">
                <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                </a>
            </td>
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
window.onload = function() {myFunction()};

function myFunction()
{
  document.getElementById("navBrand").style.color = "white";
  document.getElementById("navSellings").style.color = "white";
  document.getElementById("buttonBill").style.background = "#ccc";
  document.getElementById("buttonDetail").style.background = "#ccc"; 
  document.getElementById("filterSearchInput").placeholder = "Número de factura / Cantidad de artículos";
}
function findCoincidencesInRows() {
  var input, filter, table, tr, tdCode, tdDescription, tdDepartment, i;
  input = document.getElementById("filterSearchInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("contentTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    tdBillNumber = tr[i].getElementsByTagName("td")[0];
    tdProductQuantity = tr[i].getElementsByTagName("td")[1];
    if (tdBillNumber && tdProductQuantity) {
      if (tdBillNumber.innerHTML.toUpperCase().indexOf(filter) > -1 || tdProductQuantity.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }         
  }
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