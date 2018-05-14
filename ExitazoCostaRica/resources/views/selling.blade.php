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
  <div class="row">
     <div id="custom-search-input">
          <div class="input-group col-md-12">                          
              <input name="filterSearchInput" id="filterSearchInput" type="text" class="  search-query form-control" placeholder="Código del producto" />
              <span class="input-group-btn">
                  <button class="btn bg-dark" type="submit" onclick="agregarAListaFactura()">
                      <span class=" glyphicon glyphicon-search"></span>
                  </button>
              </span>            
          </div>
      </div>
  </div>
</div>
<br>
<a id="test"></a>
<br>
<span style="margin-left: 165px" id="billBar"></span>
<br>
<br>
<div class="container">
    <table id="contentTable" class="table table-striped">
       <thead>
          <tr class="row-name"> 
             <th>Código de barras</th>
             <th>Descripción del producto</th>
             <th>Precio venta</th>
             <th>Cantidad</th>
             <th>Importe</th>
             <th>Existencia</th>
          </tr>
       </thead>   
       <tbody id="tableBody">        
          
       </tbody>
    </table>
</div>
<br>
<div class="container">
  <div class="row">
    <h2 style="">Productos en la venta actual:&nbsp <span id="prodVentaAct">0</span></h2>
    <h2 style="float: right; margin-right: 5%" id="total">₡:&nbsp <span>0</span></h2>    
    <a href="#" onclick="pagar()" rel="nofollow" class="btn btn-default cboxElement" style="float: right; margin-right: 5%">F12 Cobrar</a>
    <a href="#" onclick="promocion()" rel="nofollow" class="btn btn-default cboxElement" style="float: right; margin-right: 5%">Aplicar Promocion</a>
  </div>
</div>
<div class="container">
  <div class="row">
    <div class="btn-group" role="group" aria-label="...">
      <a href="#" class="btn btn-default cboxElement"  type="button" value="Add" onclick="addBill()">Pendiente</a>
      <a href="#" class="btn btn-default cboxElement"  type="button" value="Delete" onclick="deleteBill()">Eliminar</a>
    </div>
  </div>
</div>
<div class="container">
  <div class="row">
    <h3 style="position: absolute;">Pagó con:&nbsp</h3>    
    <h3 style="margin-left: 10%">      
      <input type="radio" name="formaDePago" id="formaDePagoC" value="credito" checked> Crédito<br>
      <input type="radio" name="formaDePago" id="formaDePagoE" value="efectivo"> Efectivo<br>
    </h3>    
    <h3 style="position: absolute;">Cliente: <input style="width: 315px" type="text" name="nombreCliente"><a href="/buscarCliente">&nbsp<span class=" glyphicon glyphicon-search"></span></a>
    </h3>
    <br>
    <br>
    <br>    
    <h3 style="position: absolute;">Monto: <input style="width: 320px" type="text" name="montoCliente" id="montoCliente" oninput="aumentarMonto()">
      </h3>
      <div style="position: absolute; margin-left: 30%">      
        <h3 >Cambio:&nbsp <span id="cambioInpu">0</span></h3>  
      </div>    
      <a href="" rel="nofollow" class="btn btn-default cboxElement" style="float: right; margin-right: 5%">Reimprimir último tiquete</a> 
    <button onclick="irASalesAndReturnVent()" class="btn btn-default cboxElement" style="float: right; margin-right: 1.5%">Ventas del dia y devoluciones</button>
    </div>
  </div>  
</body>
<script>

var listaFactura= [];
var billNumber = 0;
var elementRow= 0;
var listaPendientes= [];
var selectedBill= 0;
var totalP= 0;

function promocion(){  
  $.ajax({
    url:"/obtener/promociones/sell",
    type:"GET",
    dataType: 'text',
    success: function(data){                
      var json = JSON.parse(data);
      var hayPromo= 0;
      var promocionesAplicadas= "Se han aplicado las promociones: ";
      console.log(json);                 
      for (var j = 0; j < listaFactura.length; j++) {                    
        for (var i = 0; i < json.length; i++) {          
          if(listaFactura[j][0][0].codigoProducto == json[i].codigoProducto && listaFactura[j][1] >= json[i].cantidadProdMinimo){
            listaFactura[j][0][0].precioVenta= json[i].precioUnit;
            listaFactura[j][2]=listaFactura[j][1] * listaFactura[j][0][0].precioVenta;
            promocionesAplicadas= promocionesAplicadas+"\n--->"+ json[i].nombrePromocion;
            hayPromo= 1;
          }
        }  
      }     
      if(hayPromo== 1){
        alert(promocionesAplicadas);  
      }
      else{
        alert("no se detectaron promociones");
      }
      agregarFilaTabla();
    },
    error: function(error){
         console.log("Error:");
         console.log(error);
    }
  });
}


function irASalesAndReturnVent(){
  var dt = new Date();
  var month = dt.getMonth()+1;
  var day = dt.getDate();
  var year = dt.getFullYear();
  var fecha= year + '-' + month + '-' + day;  
  window.location.href="/ventasDevoluciones/"+fecha;
}

function aumentarMonto(){
  montoInsertado = parseInt(document.getElementById("montoCliente").value); 
  total=montoInsertado-totalP;     
  document.getElementById("cambioInpu").innerHTML= "₡:"+ total; 
}

function mensajeParaUsuario(titulo, msj, icon){
  swal({
    title: titulo,
    text: msj,
    icon: icon,
  })
}

function limpiarTodosDatos(){  
  totalP= 0; 
  document.getElementById("nombreCliente").value= "";
  document.getElementById("montoCliente").value= "";
  document.getElementById("total").innerHTML= "";
  document.getElementById("cambioInpu").innerHTML= "₡:"+ totalP; 
  document.getElementById("total").innerHTML= "₡:"+ totalP;
}

function insertarPagoEnTablaHist(formaDePago,listaDeProductos,
  cliente,monto,prodVentaAct){     
  var dt = new Date();
  var month = dt.getMonth()+1;
  var day = dt.getDate();
  var year = dt.getFullYear();
  var fecha= year + '-' + month + '-' + day;
  var hora= cad=dt.getHours()+":"+dt.getMinutes();   
  listaDeCodigos=[];  
  for (var i = 0; i < listaFactura.length; i++) {
    listaDeCodigos.push([listaFactura[i][0][0].codigoProducto,listaFactura[i][1]]);    
  }    
  var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');  
  $.ajax({      
      url: '/crear/historialCompra',
      type: 'POST',      
      data: {_token: CSRF_TOKEN, 
        formaDePago:formaDePago,
        listaFactura: listaDeCodigos,
        cliente:cliente,
        monto: totalP,
        prodVentaAct: prodVentaAct,
        fecha: fecha,
        hora: hora},
      dataType: 'JSON',      
      success: function (data) { 
        limpiarTodosDatos();
        console.log(data);
        titulo= "Correcto";
        msj= "Se ha comprado exitosamente";
        icon="success";
        mensajeParaUsuario(titulo, msj, icon);        
      },
      error: function(error){
        titulo= "Error";
        msj= "Error: no se ha realizado la compra correctamente";
        icon="error";
        mensajeParaUsuario(titulo, msj, icon);
      }
  });     
}


function pagar(){
  formaDePago= "";    
  PagoE= document.getElementById("formaDePagoE");
  PagoC= document.getElementById("formaDePagoC");  
  cliente= document.getElementById("nombreCliente").value;  
  monto= document.getElementById("montoCliente").value;
  prodVentaAct= document.getElementById("prodVentaAct").innerHTML;
  if(PagoC.checked){
    formaDePago=PagoC.value;
  }
  else{
    formaDePago=PagoE.value;
  }
  if(listaFactura.length ==0){
    titulo= "Error";
    msj= "Error: No se poseen productos dentro de la compra";
    icon="error";
    mensajeParaUsuario(titulo, msj, icon);    
    return;
  }
  listaDeProductos= listaFactura;    
  try {
    insertarPagoEnTablaHist(formaDePago,listaDeProductos,
    cliente,monto,prodVentaAct);
    deleteBill();
  }
  catch(error) {
    alert("Error al insertar datos");
  }    
}

function seleccionarElementoTabla(id) {
  elementRow= id;    
}

function aplicarMayoreo(){  
  for (var i = 0; i< listaFactura.length; i++) {        
    listaFactura[i][3]= 1;
    listaFactura[i][2]=listaFactura[i][1] * listaFactura[i][0][0].precioMayoreo;
  }
}
  
function agregarFilaTabla(){  
  var total= 0;
  var productosEnVentaActual= 0;
  var precioVenta;
  document.getElementById("tableBody").innerHTML= "";
  for (var i = 0; i< listaFactura.length; i++) {    
    if(listaFactura[i][3] == 0){
      precioVenta= listaFactura[i][0][0].precioVenta;  
    }
    else{
      precioVenta= listaFactura[i][0][0].precioMayoreo;  
    } 

    var tr = document.createElement('tr');
    tr.className= "row-content";
    
    var td_codigoProducto = document.createElement('td');
    td_codigoProducto.innerHTML = listaFactura[i][0][0].codigoProducto;

    var td_descripcion = document.createElement('td');
    td_descripcion.innerHTML = listaFactura[i][0][0].descripcion;

    var td_precioVenta = document.createElement('td');
    td_precioVenta.innerHTML = precioVenta;
    
    var td_cantidad = document.createElement('td');
    td_cantidad.innerHTML = listaFactura[i][1];

    var td_importe = document.createElement('td');
    td_importe.innerHTML = listaFactura[i][2];
    total= total+listaFactura[i][2];

    var td_cantidadDePExist = document.createElement('td');
    td_cantidadDePExist.innerHTML = listaFactura[i][0][0].cantidadDeProduct;

    var td_botonEliminar = document.createElement('td');
    td_botonEliminar.innerHTML = "<button class='btn btn-danger edit' aria-label='Settings' onclick= 'eliminarDeLista("+i+")'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span></button>";        
    tr.appendChild(td_codigoProducto);
    tr.appendChild(td_descripcion);
    tr.appendChild(td_precioVenta);
    tr.appendChild(td_cantidad);
    tr.appendChild(td_importe);
    tr.appendChild(td_cantidadDePExist);
    tr.appendChild(td_botonEliminar);
    tr.addEventListener('click', seleccionarElementoTabla.bind(null, i));  
    document.getElementById("tableBody").appendChild(tr);  
    productosEnVentaActual=productosEnVentaActual+ listaFactura[i][1];    
  }
  document.getElementById("total").innerHTML= "";  
  document.getElementById("total").innerHTML= "₡:"+ total;
  totalP= total;

  document.getElementById("prodVentaAct").innerHTML= "";  
  document.getElementById("prodVentaAct").innerHTML= productosEnVentaActual;  
}

function eliminarDeLista(id){  
  listaFactura.splice(id, 1);
  agregarFilaTabla();
}

function agregarAListaFactura(){
  var elemento=document.getElementById('filterSearchInput').value;  
  $.ajax({
    url:"/facturas/insrtListProv/"+elemento,
    type:"GET",
    dataType: 'text',
    success: function(data){        
        cantidad= 1;
        var json = JSON.parse(data);        
        var importe= json[0].precioVenta * cantidad;    
        var mayoreo= 0;
        listaFactura.push([json,cantidad,importe,mayoreo]);        
        agregarFilaTabla();
    },
    error: function(error){
         console.log("Error:");
         console.log(error);
    }
  });
}


window.onload = function() {loadSite()};
function loadSite() {
  var t = document.getElementById("test");
  t.href = "/inventario";
  addBill();
  findBill().style.background = "#ccc";
  document.getElementById("navBrand").style.color = "white";
  document.getElementById("navSellings").style.color = "white";
  document.getElementById("buttonBill").style.background = "#ccc";
  document.getElementById("buttonDetail").style.background = "#ccc";  
}

function getBillQuantity() {
  var bill = document.getElementById("billBar");
  var billQuantity = bill.childElementCount;
  console.log(billQuantity);
  return billQuantity;
}

function onclickBoton(id){    
  if(id== 1){
    listaFactura= [];    
    agregarFilaTabla();
  }
  else{    
    listaFactura= listaPendientes[id-1][1];          
    selectedBill= id;    
    agregarFilaTabla();
  }  
}

function addBill() {
  billNumber = listaPendientes.length+1;  
  var element = document.createElement("input");
  element.setAttribute("type", "button");
  if(billNumber == 1){
    element.setAttribute("value", "factura limpia");  
  }
  else{
    element.setAttribute("value", "factura "+billNumber);
  }  
  element.setAttribute("id", billNumber);
  element.setAttribute("onclick", "onclickBoton("+billNumber+")");  
  var bill = document.getElementById("billBar");
  bill.appendChild(element);      
  listaPendientes.push([billNumber,listaFactura]);      
  listaFactura= [];  
  agregarFilaTabla();
}

function findBill() {    
  var item = document.getElementById(selectedBill);
  return item;
}


function buscarEnPendientes(id){
  for (var i = 0; i < listaPendientes.length ; i++) {
    if(listaPendientes[i][0]== id){
      alert("se encontro elemento en pos");
      alert(i);
    }
  }
}

function deleteBill() {
  var item = findBill();
  billNumber -= 1;
  if(billNumber >0){      
      item.parentNode.removeChild(item);                  
  }  
  else{
    billNumber= 1;
  }  
  listaFactura= [];
  //buscarEnPendientes(selectedBill);
  console.log(listaPendientes);
  onclickBoton(1);
}

function aumentarCantidad(){
  if(elementRow < listaFactura.length)  {
    cantidad= listaFactura[elementRow][1]+ 1;
    existencia= listaFactura[elementRow][0][0].cantidadDeProduct;
    if(cantidad <= existencia)
      if(listaFactura[elementRow][3] == 0){
        listaFactura[elementRow][2]=cantidad * listaFactura[elementRow][0][0].precioVenta;     
      }
      else{
        listaFactura[elementRow][2]=cantidad * listaFactura[elementRow][0][0].precioMayoreo;   
      }      
      listaFactura[elementRow][1]= cantidad;      
      agregarFilaTabla();
  }
}

function disminuirCantidad(){
  if(elementRow < listaFactura.length)  {
    cantidad= listaFactura[elementRow][1]-1;
    if(cantidad > 0){
      listaFactura[elementRow][1]= cantidad;
      listaFactura[elementRow][2]=cantidad * listaFactura[elementRow][0][0].precioVenta;
      agregarFilaTabla();
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
    aplicarMayoreo();
    agregarFilaTabla();
    alert("Mayoreo aplicado");
  }
  //F8
  else if(keyCode==119) {
    window.location.href = "/salidas";
  }
  //F7
  else if(keyCode==118) {
    window.location.href = "/entradas";
  }

  else if(keyCode==187){    
    aumentarCantidad();
  }
  else if(keyCode==189){    
    disminuirCantidad();
  }
}
</script>
</html>