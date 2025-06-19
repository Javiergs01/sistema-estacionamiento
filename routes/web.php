<?php

use App\Http\Controllers\PrinterController;
use App\Http\Livewire\VentasDiarias;
use App\Http\Livewire\ProximasRentas;
use App\Http\Livewire\VentasPorFecha;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\CajonController;
use App\Http\Livewire\CorteController;
use App\Http\Livewire\RentaController;
use App\Http\Livewire\TiposController;
use App\Http\Livewire\UsersController;
use App\Http\Controllers\DashController;
use App\Http\Livewire\EmpresaController;
use App\Http\Livewire\TarifasController;
use App\Http\Livewire\PermisosController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportesController;
use App\Http\Livewire\ExtraviadosController;
use App\Http\Livewire\MovimientosController;
use App\Http\Livewire\CotizacionesController;
use App\Http\Livewire\CuentasxPagarController;

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
    return view('welcome');
    //return view('auth.login');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//rutas laravel 7
Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [DashController::class, 'data'])->middleware('permission:dash');

    Route::get('empresa', EmpresaController::class)->middleware('permission:empresa_index');
    Route::get('cajones', CajonController::class)->middleware('permission:cajones_index');
    Route::get('tipos', TiposController::class)->middleware('permission:tipos_index');
    Route::get('tarifas', TarifasController::class)->middleware('permission:tarifas_index');
    Route::get('cortes', CorteController::class)->middleware('permission:cortes_index');
    Route::get('usuarios', UsersController::class)->middleware('permission:usuarios_index');


    Route::get('rentas', RentaController::class)->middleware('permission:rentas_index');
    Route::get('cotizaciones', CotizacionesController::class);
    Route::get('cuentasxpagar', CuentasxPagarController::class);


    Route::get('movimientos', MovimientosController::class)->middleware('permission:movimientos_index');
    Route::get('extraviados', ExtraviadosController::class)->middleware('permission:extraviados_index');
    Route::get('permisos', PermisosController::class)->middleware('permission:roles_index');
    //reportes en pantalla
    Route::get('ventasdiarias', VentasDiarias::class)->middleware('permission:reporte_ventasdiarias_index');
    Route::get('ventasporfechas', VentasPorFecha::class)->middleware('permission:reporte_ventasporfecha_index');
    Route::get('proximasrentas', ProximasRentas::class)->middleware('permission:reporte_rentasavencer_index');
    //reportes en pdf
    Route::get('ventasdiarias/pdf', [ReportesController::class, 'VentasDiariasPDF'])->name('ventas.diarias.pdf');
    Route::get('ventasporfecha-pdf/{f1}/{f2}', [ReportesController::class, 'VentasPorFechaPDF'])->name('ventas.porfecha.pdf');
    Route::get('rentasproximas/pdf', [ReportesController::class, 'RentasPorVencerPDF'])->name('rentas.proximas.pdf');
});

//COMENTADO DEBIDO A QUE NO SE CYUENTA CON UNA IMPRESORA TERMICA
//rutas de impresión
Route::get('print/order/{id}', [PrinterController::class, 'TicketVista']);
Route::get('ticket/pension/{id}', [PrinterController::class, 'TicketPension']);






require __DIR__ . '/auth.php';
