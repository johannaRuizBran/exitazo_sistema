<!DOCTYPE html>
<html>
<head>
  @include('partials.style')
</head>
<body>
@include('partials.nav')
<br>

<br>
<div class="container">
  <form class="form-horizontal" method="post" action="/crear/producto" accept-charset="UTF-8">
    <input type="hidden" name="_token" value="{{ csrf_token() }}"> 
      <div class="form-group">
          <label for="inputCodigoBarras" class="control-label col-xs-2">Dinero inicial en caja</label>
          <div class="col-xs-5">
              <input type="text" class="form-control" name="inputCodigoBarras" id="inputCodigoBarras" placeholder="Monto">
          </div>
      </div>
      <div class="form-group">
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
    document.getElementById("navConfig").style.color = "white";
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