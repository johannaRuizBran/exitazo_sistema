<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');





//DB PASSWORD W0XkT&rS=ba%

Route::get('/erp', function () {
    return view('auth/login');
});

Route::get('/galeria', function () {
    return view('portfolio');
});
Route::get('/config', function () {
    return view('config');
});
Route::get('/registro', function () {
    return view('auth/register');
});

Route::get('/buscarCliente', 'CustomerController@obtenerClientes');

Route::post('/prueba', 'Auth/LoginController@authenticate');


//post
Route::post('/crear/entrada', 'InventoryController@createInComing');
Route::post('/crear/salida', 'InventoryController@createOutComing');

Route::post('/crear/cliente', 'InventoryController@createClient');
Route::post('/crear/producto', 'ProductController@create');
Route::post('/crear/departamento', 'InventoryController@createDepartment');
Route::post('/crear/abono', 'CustomerController@createPaymentToAccountBD');
Route::post('/crear/promocion', 'InventoryController@createPromotion');



//Put
Route::post('/modificar/cliente/{numeroPersona}', 'CustomerController@update');
Route::put('/modificar/departamento/{id}', 'CustomerController@update');
Route::post('/modificar/producto/{codigoProducto}', 'ProductController@update');

//Delete
Route::get('/eliminar/cliente/{id}', 'CustomerController@destroy');
Route::get('/eliminar/departamento/{id}', 'DepartmentController@destroy');
Route::get('/eliminar/producto/{id}', 'ProductController@destroy');
Route::get('/eliminar/entrada/{id}', 'CustomerController@destroy');
Route::get('/eliminar/salida/{id}', 'CustomerController@destroy');
Route::get('/eliminar/promocion/{id}', 'PromotionController@destroy');


//Main views
Route::get('/clientes', 'InventoryController@customerView');
Route::get('/departamento', 'InventoryController@departmentView');
Route::get('/estadoDeCuenta/{id}', 'CustomerController@accountStatusView');
Route::get('/inventario', 'InventoryController@index');
Route::get('/promocion', 'InventoryController@promotionView');
Route::get('/reporteDeInventario', 'InventoryController@inventoryReportView');
Route::get('/reporteDeMovimiento', 'InventoryController@movementReportView');
Route::get('/entradas', 'InventoryController@inComingView');
Route::get('/salidas', 'InventoryController@outComingView');
Route::get('/tiqueteVentasDevoluciones', 'InventoryController@billSalesAndReturnsInfoView');

Route::get('/ventas', 'InventoryController@sellingView');


Route::get('/ventasPorPeriodo/{fecha}', 'InventoryController@sellingsByPeriod');
Route::get('/ventas/periodo/obtener', 'InventoryController@getSellingPeriodData');


Route::get('/facturas/insrtListProv/{id}', 'sellController@findProduct');


//Create - Update views
Route::get('/crearAbono/{numeroPersona}', 'CustomerController@paymentToAccountView');
Route::get('/crearCliente', 'CustomerController@index');
Route::get('/crearDepartamento', 'DepartmentController@index');
Route::get('/crearEntrada', 'InventoryController@createInComingView');
Route::get('/crearProducto', 'ProductController@index');
Route::get('/crearPromocion', 'PromotionController@index');
Route::get('/crearSalida', 'InventoryController@createOutComingView');

Route::get('/corte/{fecha}', 'InventoryController@showCutStadisticsView');
//Update views
Route::get('/editar/producto/{codigoProducto}', 'ProductController@goToUpdateView');
Route::get('/editar/cliente/{numeroPersona}', 'CustomerController@goToUpdateView');

//CreateMethod
Route::put('user/{id}', 'UserController@update');

Auth::routes();

//nuevas
Route::post('/devolder/producto/', 'InventoryController@devolverProductos');
Route::get('/tiqueteVentasDevoluciones/{id}/{total}/{tipoPago}', 'InventoryController@billSalesAndReturnsInfoView');
Route::get('/ventasDevoluciones/{fecha}', 'InventoryController@salesAndReturnsView');
Route::get('/facturas/insrtListProv/{id}', 'sellController@findProduct');
Route::get('/obtener/promociones/sell', 'sellController@obtenerPromocion');
Route::post('/crear/historialCompra', 'sellController@insertarEnHistorial');

Route::post('/insertarListaFacturas', 'sellController@insertarEnListaFacturas');
Route::get('/obtener/datosFacturas', 'sellController@obtenerDatosBDFacturas');