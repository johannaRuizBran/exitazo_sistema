<div class="container">
  <div class="row">
    <div class="btn-group" role="group" >
      <a href="/inventario" class="btn btn-default cboxElement" id="buttonProducts">Productos</a>
      <a href="/departamento" class="btn btn-default cboxElement" id="buttonDepartments">Departamentos</a>
      
      <a onclick="irAVista()" class="btn btn-default cboxElement" id="buttonPeriodicSellings">Ventas por período</a>

      <a href="/promocion" class="btn btn-default cboxElement" id="buttonPromotions">Promociones</a>
      <a href="/reporteDeMovimiento" class="btn btn-default cboxElement" id="buttonMovementsReport">Reporte de movimientos</a>
    </div>
  </div>
</div>
<script type="text/javascript">
	function irAVista(){
	  var dt = new Date();
	  var month = dt.getMonth()+1;
	  var day = dt.getDate();
	  var year = dt.getFullYear();
	  var fecha= year + '-' + month + '-' + day;  
	  window.location.href="/ventasPorPeriodo/"+fecha;
	}
</script>