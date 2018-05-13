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
    public function findProduct($filterSearchInput){    	
    	$productos = DB::table('PRODUCTOS')->select('codigoProducto', 'descripcion','precioCosto','precioVenta','precioMayoreo',
            'nombreDepartamento','cantidadDeProduct','cantMinimaProd')->where('codigoProducto', '=', $filterSearchInput)->get();
    	return $productos;    	
    }
}