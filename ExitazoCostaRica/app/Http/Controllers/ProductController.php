<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use DB;
use Redirect;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
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
        return view('createProduct', compact('productos'));        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $inputCodigoBarras = $request->input('inputCodigoBarras');
        $inputDesc = $request->input('inputDesc');            
        $inputPrecioCosto = $request->input('inputPrecioCosto');
        $inputPrecioVenta = $request->input('inputPrecioVenta');
        $inputPrecioMayoreo = $request->input('inputPrecioMayoreo');
        $inputCantidad = $request->input('inputCantidad');
        $inputMinimo = $request->input('inputMinimo');
        
        
        DB::insert('insert into PRODUCTOS(codigoProducto,descripcion,precioCosto,precioVenta,precioMayoreo,nombreDepartamento,cantidadDeProduct,cantMinimaProd) values(?,?,?,?,?,?,?,?)',
            [$inputCodigoBarras,$inputDesc,$inputPrecioCosto,$inputPrecioVenta,$inputPrecioMayoreo,'zapatos',$inputCantidad,$inputMinimo]);     

        /*POR MIENTRAS*/   
        $productos = DB::table('PRODUCTOS')->select('codigoProducto', 'descripcion','precioCosto','precioVenta','precioMayoreo',
            'nombreDepartamento','cantidadDeProduct','cantMinimaProd')->get();
        return view('inventories', compact('productos'));
    }

    public function goToUpdateView ($codigoProducto) 
    {
        $product = DB::table('PRODUCTOS')->where('codigoProducto', $codigoProducto)->first();
        return view('updateProduct', compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $codigoProducto)
    {
        //
        DB::table('PRODUCTOS')
            ->where('codigoProducto', $codigoProducto)
            ->update(['descripcion' => $request->input('inputDescripcion'), 
                        'precioCosto' => $request->input('inputPrecioCosto'), 
                        'precioVenta' => $request->input('inputPrecioVenta'), 
                        'precioMayoreo' => $request->input('inputPrecioMayoreo'),
                        'nombreDepartamento' => $request->input('inputNombreDepartamento'),
                        'cantidadDeProduct' => $request->input('inputCantidadDeProduct')
                ]);
        return redirect()->action('InventoryController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('PRODUCTOS')
        ->where('codigoProducto', $id)
        ->delete();
        return Redirect::to('/inventario');
    }
}
