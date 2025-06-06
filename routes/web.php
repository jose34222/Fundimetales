<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\GastoController;
use App\Http\Controllers\ConceptoController;	
use App\Http\Controllers\EnvioController;
use App\Http\Controllers\ChequeController;
use App\Http\Controllers\CuentaBancariaController;	
use App\Http\Controllers\VentaController;
use App\Http\Controllers\DepositoController;	
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\ResetPassword;
use App\Http\Controllers\ChangePassword; 
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\ServicioController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\MovimientoInventarioController;

Route::resource('clientes', ClienteController::class)->middleware('auth');
Route::resource('gastos', GastoController::class)->middleware('auth');
Route::resource('conceptos', ConceptoController::class)->middleware('auth');
Route::resource('envios', EnvioController::class)->middleware('auth');	
Route::resource('cheques', ChequeController::class)->middleware('auth');
Route::resource('cuentas', CuentaBancariaController::class)->middleware('auth');
Route::resource('ventas', VentaController::class)->middleware('auth');
Route::resource('depositos', DepositoController::class)->middleware('auth');	
Route::resource('categorias', CategoriaController::class)->middleware('auth');
Route::get('categorias/{id}/productos', [CategoriaController::class, 'productos'])->name('categorias.productos')->middleware('auth');
Route::resource('proveedores', ProveedorController::class);
Route::get('proveedores/{id}/productos', [ProveedorController::class, 'productos'])->name('proveedores.productos');
Route::resource('servicios', ServicioController::class)->middleware('auth');
Route::resource('productos', ProductoController::class)->middleware('auth');
// Rutas personalizadas para Kardex, Entrada y Ajuste de Inventario
Route::get('productos/{id}/kardex', [ProductoController::class, 'kardex'])->name('productos.kardex');
Route::post('productos/{id}/entrada', [ProductoController::class, 'entradaInventario'])->name('productos.entrada');
Route::post('productos/{id}/ajuste', [ProductoController::class, 'ajusteInventario'])->name('productos.ajuste');

// Mostrar todos los movimientos de inventario
Route::get('/movimientos', [MovimientoInventarioController::class, 'index'])->name('movimientos.index');

// Mostrar movimientos de un producto específico
Route::get('/movimientos/producto/{productoId}', [MovimientoInventarioController::class, 'movimientosPorProducto'])->name('movimientos.por-producto');

// Mostrar movimientos entre fechas específicas
Route::post('/movimientos/por-fecha', [MovimientoInventarioController::class, 'movimientosPorFecha'])->name('movimientos.por-fecha');

// Mostrar resumen de inventario (todos los productos)
Route::get('/movimientos/resumen-inventario', [MovimientoInventarioController::class, 'resumenInventario'])->name('movimientos.resumen');

// Mostrar productos con stock bajo o igual al mínimo
Route::get('/movimientos/productos-bajo-stock', [MovimientoInventarioController::class, 'productosBajoStock'])->name('movimientos.bajo-stock');

Route::get('/', function () {
    return redirect('/dashboard');
})->middleware('auth');
	Route::get('/register', [RegisterController::class, 'create'])->middleware('guest')->name('register');
	Route::post('/register', [RegisterController::class, 'store'])->middleware('guest')->name('register.perform');
	Route::get('/login', [LoginController::class, 'show'])->middleware('guest')->name('login');
	Route::post('/login', [LoginController::class, 'login'])->middleware('guest')->name('login.perform');
	Route::get('/reset-password', [ResetPassword::class, 'show'])->middleware('guest')->name('reset-password');
	Route::post('/reset-password', [ResetPassword::class, 'send'])->middleware('guest')->name('reset.perform');
	Route::get('/change-password', [ChangePassword::class, 'show'])->middleware('guest')->name('change-password');
	Route::post('/change-password', [ChangePassword::class, 'update'])->middleware('guest')->name('change.perform');
	Route::get('/dashboard', [HomeController::class, 'index'])->name('home')->middleware('auth');
Route::group(['middleware' => 'auth'], function () {
	Route::get('/virtual-reality', [PageController::class, 'vr'])->name('virtual-reality');
	Route::get('/rtl', [PageController::class, 'rtl'])->name('rtl');
	Route::get('/profile', [UserProfileController::class, 'show'])->name('profile');
	Route::post('/profile', [UserProfileController::class, 'update'])->name('profile.update');
	Route::get('/profile-static', [PageController::class, 'profile'])->name('profile-static'); 
	Route::get('/sign-in-static', [PageController::class, 'signin'])->name('sign-in-static');
	Route::get('/sign-up-static', [PageController::class, 'signup'])->name('sign-up-static'); 
	Route::get('/{page}', [PageController::class, 'index'])->name('page');
	Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});


