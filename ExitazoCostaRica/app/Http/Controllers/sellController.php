<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Quotation;
use Redirect;

class sellController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        return view('createDepartment');
    }
			
	/*
	<th>Código de barras</th>
             <th>Descripción del producto</th>
             <th>Precio venta</th>
             <th>Cantidad</th>
             <th>Importe</th>
             <th>Existencia</th>
	*/	
    public function obtenerPromocion(){
        $idReg = DB::table('PROMOCIONES')->get();
        return $idReg;      
    }

    public function insertarEnHistorial(Request $request){
        $fecha= $request->fecha;
        $hora= $request->hora;
        $formaDePago= $request->formaDePago;
        $listaFactura =$request->listaFactura;
        $cliente= $request->cliente;
        $monto= $request->monto;
        $cantidadProductos= $request->prodVentaAct;        
        $resultado= "Error no se han introducido los datos de forma correcta";

        DB::update('update CLIENTES set saldoActual=saldoActual + ? where numeroPersona = ?',[$monto,$cliente]);

        DB::insert('insert into MOVIMIENTOS_CAJAS(tipo,motivo,nombreLocal,montoDinero,fecha) values(?,?,?,?,?)',
            ['credito','venta de producto','nombreLocal',$monto,$fecha]);        

        $insertHist=DB::insert('insert into HISTORIAL(fecha,monto,cliente,tipoPago,cantidadArticulos,hora) values(?,?,?,?,?,?)',[$fecha,$monto,$cliente,$formaDePago,$cantidadProductos,$hora]);        
        if($insertHist){
            $idReg = DB::table('HISTORIAL')->orderBy('id', 'DESC')->get();
            for ($i=0; $i < sizeof($listaFactura); $i++) {               
                DB::insert('insert into PRODUCTOS_COMPRADOS(idHistorial,cantidad,codigoProducto,monto) values(?,?,?,?)',
                [$idReg[0]->id, $listaFactura[$i][1],$listaFactura[$i][0],$listaFactura[$i][2]]);
                
                DB::update('update PRODUCTOS set cantidadDeProduct=cantidadDeProduct - ? where codigoProducto = ?',[$listaFactura[$i][1],$listaFactura[$i][0]]);
            }
            $resultado= "Se ha realizado exitosamente";
        }        
        $response = array(
          'msj' => $resultado,
        );
        return response()->json($response); 
   }


    public function findProduct($filterSearchInput){        
        $productos = DB::table('PRODUCTOS')->select('codigoProducto', 'descripcion','precioCosto','precioVenta','precioMayoreo',
            'nombreDepartamento','cantidadDeProduct','cantMinimaProd')->where('codigoProducto', '=', $filterSearchInput)->get();
        return $productos;      
    }
}