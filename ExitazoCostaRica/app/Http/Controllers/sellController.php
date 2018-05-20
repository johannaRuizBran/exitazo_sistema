<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

    public function obtenerDatosBDFacturas(){
        $nombreCajero= Auth::user()->name;                   
        $result= DB::table('PRODUCTOS_FACTURAS')->where('nombreCajero', '=', $nombreCajero)->get();
        return $result;
    }

    public function obtenerPromocion(){
        $idReg = DB::table('PROMOCIONES')->get();
        return $idReg;      
    }

    public function insertarEnListaFacturas(Request $request){        
        $listaFacturaPendiente =$request->listaPendientes;               
        $resultado= $listaFacturaPendiente; 
        $nombreCajero= Auth::user()->name;                   
        $resultado2="";
        $resultado3="";        
        try{            
            if( sizeof($listaFacturaPendiente) > 1){
                DB::table('PRODUCTOS_FACTURAS')->where('nombreCajero', '=', $nombreCajero)->delete();
            }
            for ($i=1;  $i< sizeof($listaFacturaPendiente) ; $i++) {
                $listaFactura= $listaFacturaPendiente[$i][1];            
                $billNumber= $listaFacturaPendiente[$i][0];
                $resultado2=  $listaFacturaPendiente[$i];
                for ($j=0;  $j< sizeof($listaFactura) ; $j++) {
                    $json=$listaFactura[$j][0];
                    $cantidad= $listaFactura[$j][1];
                    $importe= $listaFactura[$j][2];
                    $mayoreo= $listaFactura[$j][3];                     
                    for ($k=0; $k < sizeof($json); $k++) {
                        $codigoProducto= $json[$k]['codigoProducto'];
                        DB::insert('insert into PRODUCTOS_FACTURAS(nombreCajero,cantidad,importe,mayoreo,billNumber,idProducto) values(?,?,?,?,?,?)',[$nombreCajero,$cantidad,$importe,$mayoreo,$billNumber,$codigoProducto]);  
                    }
                }
            }       
            $response = array(
              'msj1' => $resultado,
              'mes2'=>$resultado2
            );
        }
        catch (Exception $e){
            $response = array(
              'msj' => $e
            );
        }                
        return response()->json($response); 
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

        $insertHist=DB::insert('insert into HISTORIAL(fecha,monto,cliente,tipoPago,cantidadArticulos,hora) values(?,?,?,?,?,?)',[$fecha,$monto,$cliente,$formaDePago,$cantidadProductos,$hora]);        
        if($insertHist){
            $idReg = DB::table('HISTORIAL')->orderBy('id', 'DESC')->get();
            for ($i=0; $i < sizeof($listaFactura); $i++) {               
                DB::insert('insert into PRODUCTOS_COMPRADOS(idHistorial,cantidad,codigoProducto,monto) values(?,?,?,?)',
                [$idReg[0]->id, $listaFactura[$i][1],$listaFactura[$i][0],$listaFactura[$i][2]]);
                
                DB::update('update PRODUCTOS set cantidadDeProduct=cantidadDeProduct - ? where codigoProducto = ?',[$listaFactura[$i][1],$listaFactura[$i][0]]);

                DB::insert('insert into MOVIMIENTOS_PRODUCTOS(codigoProducto,tipoMovimientoProd,fechaMovimiento,hora,cantidad,cajero,nombreDepartamento,habia,nombreLocal) values(?,?,?,?,?,?,?,?,?)',
                [$listaFactura[$i][0],'salida',$fecha,$hora,$listaFactura[$i][1],Auth::user()->name, $listaFactura[$i][4], $listaFactura[$i][3], 'local uno']);
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