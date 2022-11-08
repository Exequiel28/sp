<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
//agregamos los siguientes controladores
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\InventarioController;
use App\Http\Controllers\UserSettingsController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\OrdenController;
use App\Http\Controllers\FacturaController;

use App\Models\Inventario;
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
    return view('auth.login');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/NewPassword',  [UserSettingsController::class,'NewPassword'])->name('NewPassword')->middleware('auth');
Route::post('/change/password',  [UserSettingsController::class,'changePassword'])->name('changePassword');

//y creamos un grupo de rutas protegidas para los controladores
Route::group(['middleware' => ['auth']], function() {

    Route::get('inventario/uso', [InventarioController::class, 'uso'])->name('inventario.uso');
    Route::get('pedidos/pendientes', [PedidoController::class, 'pendientes'])->name('pedidos.pendientes');
    Route::get('pedidos/terminados', [PedidoController::class, 'terminados'])->name('pedidos.terminados');
    Route::get('pedidos/entregados', [PedidoController::class, 'entregados'])->name('pedidos.entregados');
    Route::get('ordenes/index', [OrdenController::class, 'index2'])->name('ordenes.index2');

    Route::get('reportes/resultado', [HomeController::class, 'consulta'])->name('home.consulta');
    Route::get('reportes/index', [HomeController::class, 'reportes'])->name('reportes.index');
    Route::get('download-pdf/', [HomeController::class, 'downloadPDF'])->name('download-pdf');
    Route::get('download-pdf1/', [HomeController::class, 'downloadPDF1'])->name('download-pdf1');
    


    Route::get('ordenes/ordendis', [OrdenController::class, 'ordendis'])->name('ordenes.ordendis');
    Route::get('ordenes/ordenimp', [OrdenController::class, 'ordenimp'])->name('ordenes.ordenimp');
    Route::get('ordenes/ordenaca', [OrdenController::class, 'ordenaca'])->name('ordenes.ordenaca');

    Route::get('facturacion/index2/{id}', [FacturaController::class, 'index2'])->name('facturacion.index2');
    Route::get('facturacion/recibo/{id}', [FacturaController::class, 'recibo'])->name('facturacion.recibo');
    Route::get('facturacion/factura/{id}', [FacturaController::class, 'factura'])->name('facturacion.factura');
    Route::get('facturacion/cfiscal/{id}', [FacturaController::class, 'cfiscal'])->name('facturacion.cfiscal');
    
    Route::get('pedidos/index/{id}', [PedidoController::class, 'cestado'])->name('pedidos.cestado');
    Route::get('pedidos/show/{id}', [PedidoController::class, 'cestado1'])->name('pedidos.cestado1');

    Route::get('ordenes/ordendis/{id}', [OrdenController::class, 'camestado1'])->name('ordenes.camestado1');
    Route::get('ordenes/ordenimp/{id}', [OrdenController::class, 'camestado2'])->name('ordenes.camestado2');
    Route::get('ordenes/ordenaca/{id}', [OrdenController::class, 'camestado3'])->name('ordenes.camestado3');
    
    Route::get('productos/cambio_de_estado/{id}', [ProductoController::class, 'cambio_de_estado'])->name('cambio.estado');
    

    Route::get('inventario/increment', [App\Http\Controllers\InventarioController::class, 'increment'])->name('inventario.increment');
    
    Route::resource('roles', RolController::class);
    Route::resource('usuarios', UsuarioController::class);
    Route::resource('inventario', InventarioController::class);
    Route::resource('clientes', ClienteController::class);
    Route::resource('productos', ProductoController::class);
    Route::resource('pedidos', PedidoController::class);
    Route::resource('ordenes', OrdenController::class);
    Route::resource('facturacion', FacturaController::class);

    Route::get('inventario/edit2/{id}', [InventarioController::class, 'increment'])->name('inventario.increment');
    Route::get('inventario/edit3/{id}', [InventarioController::class, 'increment1'])->name('inventario.increment1');
    Route::get('inventario/edit4/{id}', [InventarioController::class, 'increment2'])->name('inventario.increment2');
    Route::get('inventario/agregar/{id}', [InventarioController::class, 'agregar'])->name('inventario.agregar');
    Route::get('pedidos/create/{id}', [PedidoController::class, 'agregar'])->name('pedidos.agregar');
    Route::get('ordenes/create/{id}', [OrdenController::class, 'create'])->name('ordenes.create');

    
   // Route::get('pedidos/pendientes', [PedidoController::class, 'pendientes']);
   

   

   
    
  //  Route::get('productos/cambio_de_estado/{producto}', [ProductoController::class, 'cambio_de_estado'])->name('cambio.estado.producto');
   // Route::get('productos/{producto}', [ProductoController::class, 'cambio_de_estado'])->name('cambio.estado.producto');

   
   //Route::get('productos/cambio_de_estado/{producto}', [App\Http\Controllers\ProductoController::class, 'cambio_de_estado'])->name('cambio.estado');
    

    Route::post('inventario/update2/{id}', [App\Http\Controllers\InventarioController::class, 'update2'])->name('inventario.update2');
    Route::post('inventario/update3/{id}', [App\Http\Controllers\InventarioController::class, 'update3'])->name('inventario.update3');
    Route::post('inventario/update4/{id}', [App\Http\Controllers\InventarioController::class, 'update4'])->name('inventario.update4');
    Route::post('inventario/usando/{id}', [App\Http\Controllers\InventarioController::class, 'usando'])->name('inventario.usando');
    



   
});