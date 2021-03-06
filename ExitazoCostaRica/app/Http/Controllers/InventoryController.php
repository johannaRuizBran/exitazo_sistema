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

    public function showCutStadisticsView($fecha)
    {
        $initialDate= $fecha;
        $finalDate= $fecha;

        if ($initialDate == 0) {
             $initialDate = date('Y-m-d');
             if ($finalDate == 0) {
                    $finalDate = $initialDate;
             }
        }
        else if ($finalDate == 0 && $initialDate != 0) {
            $finalDate = $initialDate;
        }
        $initialDate = date_format(date_create($initialDate), 'Y-m-d');
        $finalDate = date_format(date_create($finalDate), 'Y-m-d');
        $initialDate = date_format(date_create($initialDate), 'Y-m-d');
        $finalDate = date_format(date_create($finalDate), 'Y-m-d');

        $dineroInicialCaja=DB::table('LOCALES')->where('nombreLocal', '=', 'local uno')->get();

        $pagosContado = DB::select('call pagosContado(?,?)',[$initialDate,$finalDate]);

        $ventasDepartamento = DB::select('call ventasDepartamento(?,?)',[$initialDate,$finalDate]);

        $pagoClientes = DB::select('call pagoClientes(?,?)',[$initialDate,$finalDate]);

        $repagoProveedoressults = DB::select('call pagoProveedores(?,?)',[$initialDate,$finalDate]);
        
        $reporteMovimientos = DB::select('call reporteMovimientos(?,?)',[$initialDate,$finalDate]);
        
        return view('showCutStadistics', compact('pagosContado', 'ventasDepartamento', 'pagoClientes', 'repagoProveedoressults', 'reporteMovimientos','dineroInicialCaja'));
        //return view('showCutStadistics');
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
        $clientes = DB::table('CLIENTES')->select('numeroPersona', 'nombrePersona','direccion','telefono','limiteDeCredito',
            'saldoActual')->get(); 
        $productos = DB::table('PRODUCTOS')->select('codigoProducto', 'descripcion','precioCosto','precioVenta','precioMayoreo',
            'nombreDepartamento','cantidadDeProduct','cantMinimaProd')->get();   
        return view('selling',compact('lista','clientes','productos'));
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

    public function sellingsByPeriod($fecha) 
    {    
        $initialDate = $fecha;
        $finalDate = $fecha;
        $results = DB::select('call ventasPeriodo(?,?)',[$initialDate,$finalDate]);
        return view('sellingPeriod', compact('results'));
    }

    public function getSellingPeriodData(Request $request){
        $initialDate= $request->initialDate;
        $finalDate= $request->finalDate;
        if ($initialDate == 0) {
            $initialDate = date('Y-m-d');
            if ($finalDate == 0) {
                $finalDate = $initialDate;
            }
        }
        else if ($finalDate == 0 && $initialDate != 0) {
            $finalDate = $initialDate;
        }
        $initialDate = date_format(date_create($initialDate), 'Y-m-d');
        $finalDate = date_format(date_create($finalDate), 'Y-m-d');
        $results = DB::select('call ventasPeriodo(?,?)',[$initialDate,$finalDate]);                               
        return $results;
    }
}
