<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Quotation;
use Redirect;

class InventoryController extends Controller
{
    /**
     * Display the product list and main view of inventories
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $productos = DB::table('PRODUCTOS')->select('codigoProducto', 'descripcion','precioCosto','precioVenta','precioMayoreo',
            'nombreDepartamento','cantidadDeProduct','cantMinimaProd')->get();
        return view('inventories', compact('productos'));
    }

    public function customerView()
    {
        $clientes = DB::table('CLIENTES')->select('numeroPersona', 'nombrePersona','direccion','telefono','limiteDeCredito',
            'saldoActual')->get();        
        return view('customers', compact('clientes'));
    }

    public function createClient(Request $request){
        $inputNombre = $request->input('inputNombre');
        $inputDireccion = $request->input('inputDireccion');
        $inputTelefono = $request->input('inputTelefono');
        $inputLimiteCredito = $request->input('inputLimiteCredito');
        $saldoActual= '0';

        DB::insert('insert into CLIENTES(nombrePersona,direccion,telefono,limiteDeCredito,saldoActual) values(?,?,?,?,?)',[$inputNombre,$inputDireccion,$inputTelefono,
            $inputLimiteCredito,$saldoActual]);            

        /*POR MIENTRAS*/   
        $clientes = DB::table('CLIENTES')->select('numeroPersona', 'nombrePersona','direccion','telefono','limiteDeCredito',
            'saldoActual')->get();        
        return view('customers', compact('clientes'));
    }

    public function createOutComingView()
    {
        return view('createOutComing');
    }

    public function createInComingView()
    {
        return view('createInComing');
    }

    public function showCutStadisticsView()
    {
        return view('showCutStadistics');
    }

    public function departmentView()
    {
        $departamentos = DB::table('DEPARTAMENTOS')->select('nombreDepartamento')->get();        
        return view('departments', compact('departamentos'));        
    }

    public function createDepartment(Request $request)
    {
        $inputMontoDinero = $request->input('inputDepart');
        DB::insert('insert into DEPARTAMENTOS(nombreDepartamento) values(?)',[$inputMontoDinero]);            
        /*POR MIENTRAS*/           
        $departamentos = DB::table('DEPARTAMENTOS')->select('nombreDepartamento')->get();        
        return view('departments', compact('departamentos'));        
    }

    public function sellingPeriodView()
    {
        return view('sellingPeriod');
    }

    public function salesAndReturnsView($fecha)
    {
        $registrosHistorial = DB::table('HISTORIAL')->where('fecha', '=', $fecha)->get();        
        return view('salesAndReturns', compact('registrosHistorial'));
    }

    public function devolverProductos(Request $request){        

        $lista = $request->input('lista');        
        $fecha = $request->input('fecha');
        $listaProductos = json_decode($lista);        
        $idHistorial= $listaProductos[0]->idHistorial;               
                       
        for ($i=0; $i < sizeof($listaProductos); $i++) {
            DB::update('update PRODUCTOS set cantidadDeProduct=cantidadDeProduct + ? where codigoProducto = ?',[$listaProductos[$i]->cantidad, $listaProductos[$i]->codigoProducto]); 
        }
        DB::table('HISTORIAL')->where('id','=',$idHistorial)->delete();
        $resultado= "Se ha realizado exitosamente";
        return view('selling'); 
    }


    public function billSalesAndReturnsInfoView($idHistorial,$total,$tipoPago)
    {                    
        $registrosHistorial = DB::table('PRODUCTOS_COMPRADOS')->join('PRODUCTOS', 'PRODUCTOS.codigoProducto', '=', 'PRODUCTOS_COMPRADOS.codigoProducto')->select('PRODUCTOS_COMPRADOS.*', 'PRODUCTOS.descripcion','PRODUCTOS.precioVenta')->where('PRODUCTOS_COMPRADOS.idHistorial','=',$idHistorial)->get();     
        return view('billSalesAndReturnsInfo',compact('registrosHistorial', 'total','tipoPago'));
    }
    

    public function promotionView()
    {        
        $promociones = DB::table('PROMOCIONES')->select('nombrePromocion', 'codigoProducto','cantidadProdMinimo','cantidadProdMax','precioUnit')->get();
        return view('promotions',compact('promociones'));
    }

    public function createPromotion(Request $request)
    {        
        $inputnombre = $request->input('inputnombre');
        $inputCodBarras = $request->input('inputCodBarras');            
        $inputCantidadInicial = $request->input('inputCantidadInicial');
        $inputCantidadFinal = $request->input('inputCantidadFinal');
        $inputPrecio = $request->input('inputPrecio');                   
        
        DB::insert('insert into PROMOCIONES(nombrePromocion,codigoProducto,cantidadProdMinimo,cantidadProdMax,precioUnit) values(?,?,?,?,?)',
            [$inputnombre,$inputCodBarras,$inputCantidadInicial,$inputCantidadFinal,$inputPrecio]);            

        /*POR MIENTRAS*/   
        $promociones = DB::table('PROMOCIONES')->select('nombrePromocion', 'codigoProducto','cantidadProdMinimo','cantidadProdMax','precioUnit')->get();
        return view('promotions',compact('promociones'));
    }

    public function inventoryReportView()
    {
        return view('inventoryReport');
    }

    public function sellingView()
    {
        $lista=[];
        return view('selling',compact('lista'));
    }

    public function movementReportView()
    {
        return view('movementReport');
    }

    public function outComingView()
    {
        $salidas = DB::table('MOVIMIENTOS_CAJAS')->select('id', 'tipo','motivo','montoDinero','fecha')->where('tipo', '=', 'salida')->get();
        return view('outComing',compact('salidas'));
    }

    public function inComingView()
    {
        $entradas = DB::table('MOVIMIENTOS_CAJAS')->select('id', 'tipo','motivo','montoDinero','fecha')->where('tipo', '=', 'entrada')->get();
        return view('inComing', compact('entradas'));        
    }
    
    public function createOutComing(Request $request){
        $inputMontoDinero = $request->input('inputMonto');
        $inputMotivo = $request->input('inputMotivo');        
        $fecha= getdate();
        $fechaDia= $fecha['mday'];
        $fechaMes= $fecha['mon'];
        $fechaAnno= $fecha['year'];
        
        $fecha=$fechaAnno."-".$fechaMes."-".$fechaDia;
        DB::insert('insert into MOVIMIENTOS_CAJAS(tipo,motivo,montoDinero,fecha) values(?,?,?,?)',['salida',
            $inputMotivo,$inputMontoDinero,$fecha]);            

        /*POR MIENTRAS*/   
        $salidas = DB::table('MOVIMIENTOS_CAJAS')->select('id', 'tipo','motivo','montoDinero','fecha')->where('tipo', '=', 'salida')->get();
        return view('outComing',compact('salidas'));
    }


    public function createInComing(Request $request)
    {        
        $inputMontoDinero = $request->input('inputMonto');
        $inputMotivo = $request->input('inputMotivo');        
        $fecha= getdate();
        $fechaDia= $fecha['mday'];
        $fechaMes= $fecha['mon'];
        $fechaAnno= $fecha['year'];
        
        $fecha=$fechaAnno."-".$fechaMes."-".$fechaDia;
        DB::insert('insert into MOVIMIENTOS_CAJAS(tipo,motivo,montoDinero,fecha) values(?,?,?,?)',['entrada',
            $inputMotivo,$inputMontoDinero,$fecha]);            

        /*POR MIENTRAS*/   
        $entradas = DB::table('MOVIMIENTOS_CAJAS')->select('id', 'tipo','motivo','montoDinero','fecha')->where('tipo', '=', 'entrada')->get();
        return view('inComing', compact('entradas'));
    }

    public function sellingsByPeriod($initialDate, $finalDate) 
    {
        /*SELECT PRODUCTOS.codigoProducto, PRODUCTOS.descripcion, PRODUCTOS.precioCosto, PRODUCTOS.precioVenta, PRODUCTOS.precioMayoreo, PRODUCTOS.nombreDepartamento, SUM(PRODUCTOS_COMPRADOS.cantidad) as cantidad
   FROM PRODUCTOS LEFT JOIN PRODUCTOS_COMPRADOS 
   ON PRODUCTOS.codigoProducto = PRODUCTOS_COMPRADOS.codigoProducto 
   inner join HISTORIAL 
   on PRODUCTOS_COMPRADOS.idHistorial = HISTORIAL.id and HISTORIAL.fecha between '2018-11-14' and '2018-12-20'
   GROUP BY PRODUCTOS.codigoProducto, PRODUCTOS.descripcion
*/
        $results = DB::select('call my_stored_procedure(?,?)',[$initialDate,$finalDate]);
        echo $results[0]->codigoProducto;
        return view('sellingPeriod', compact('results'));
        
    }
}
