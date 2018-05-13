<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;
use DB;
use Redirect;

class CustomerController extends Controller
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
        //
        return view('createCustomer');
    }

    public function accountStatusView($customer)
    {
        //
        $abonos = DB::table('ABONOS')->where('numeroPersona', $customer)->get();
        $user = DB::table('CLIENTES')->where('numeroPersona', $customer)->first();
        return view('accountStatus', compact('user','abonos'));
    }

    public function paymentToAccountView($numeroPersona)
    {
        return view('createPaymentToAccount', compact('numeroPersona'));
    }

    public function createPaymentToAccountBD(Request $request){
        $inputFecha = $request->input('inputFechaAbono');
        $inputAbono = $request->input('inputAbono');                
        $persona = $request->input('persona');                
        
        DB::insert('insert into ABONOS(fechaAbono,monto,numeroPersona) values(?,?,?)',[$inputFecha,$inputAbono,$persona]);

        DB::update('update CLIENTES set saldoActual= saldoActual - ? where numeroPersona = ?',[$inputAbono,$persona]);
        
        //por mientras
        $abonos = DB::table('ABONOS')->where('numeroPersona', $persona)->get();
        $user = DB::table('CLIENTES')->where('numeroPersona', $persona)->first();
        return view('accountStatus', compact('user','abonos'));
    }

    public function goToUpdateView ($numeroPersona) 
    {
        $user = DB::table('CLIENTES')->where('numeroPersona', $numeroPersona)->first();
        return view('updateCustomer', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $numeroPersona)
    {
        //
        DB::table('CLIENTES')
            ->where('numeroPersona', $numeroPersona)
            ->update(['nombrePersona' => $request->input('inputNombre'), 
                        'direccion' => $request->input('inputDireccion'), 
                        'telefono' => $request->input('inputTelefono'), 
                        'limiteDeCredito' => $request->input('inputLimiteCredito')]);

        return redirect()->action('InventoryController@customerView');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('CLIENTES')
        ->where('numeroPersona', $id)
        ->delete();
        return Redirect::to('/clientes');
    }
}
