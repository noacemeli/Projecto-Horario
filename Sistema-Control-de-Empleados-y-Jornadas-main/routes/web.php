<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EventoController;
use App\Http\Controllers\RegistroController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FicharController;
use App\Http\Controllers\GestionEmpleadosController;
use App\Http\Controllers\HorarioGeneralController;
use App\Http\Controllers\SolicitudController;
use App\Http\Controllers\SolicitudesPendientesController;
use App\Http\Controllers\ArchivoController;
use League\Csv\Writer;
use App\Models\Solicitud;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    if(Auth::check() && Auth::user()->rol==='admin'){
        return view('admin.fichar');
    }else if(Auth::check() && Auth::user()->rol==='employee'){
        return view('employee.fichar');
    }else{
        return view('auth.login');
    };
});


Route::match(['get', 'post'],'/registrar-entrada-salida', [FicharController::class, 'registrarEntradaSalida'])->name('registrar-entrada-salida');
Route::post('/subir-archivo', [ArchivoController::class, 'subirArchivo'])->name('archivo.subir');





Route::middleware(['rol:admin'])->group(function () {
    Route::get('/exportar-csv', 'ExportController@exportarCSV')->name('exportar.csv');
    Route::get('/admin/horarioGeneral', 'HorarioGeneralController@horarioGeneral')->name('admin.horarioGeneral');
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/dashboard/horarios',[RegistroController::class, 'index'])->name('admin.horarios');
    Route::get('/addEmployee-form' , function(){ return view('auth.register'); })->name('add.employee.form');
    Route::post('/addEmployee', [UserController::class, 'create'] )->name('add.employee');
    Route::get('/admin-fichar', function(){return view('admin.fichar');})->name('fichar-admin');
    Route::get('/mostrar-horario-general', [HorarioGeneralController::class, 'horarioGeneral'])->name('mostrar.horario.general');
    Route::get('/admin/usuarios', [GestionEmpleadosController::class, 'gestion'])->name('admin.usuarios');
    Route::put('/usuarios/{usuario}/desactivar', [GestionEmpleadosController::class, 'desactivar'])->name('usuarios.desactivar');
    Route::put('/usuarios/{usuario}/reactivar', [GestionEmpleadosController::class, 'reactivar'])->name('usuarios.reactivar');
    Route::get('/solicitudes-pendientes', [SolicitudesPendientesController::class, 'showPending'])->name('solicitudes-pendientes');
    Route::post('/aprobar/{solicitud}', [SolicitudesPendientesController::class, 'approve'])->name('approve');
    Route::post('/desaprobar/{solicitud}', [SolicitudesPendientesController::class, 'reject'])->name('reject');
    Route::get('/eventos',[EventoController::class, 'show'])->name('eventos');
    Route::view('/calendario','admin.calendario')->name('calendario');
    Route::get('/admin/horarioGeneral', [HorarioGeneralController::class, 'horarioGeneral'])->name('admin.horarioGeneral');
    Route::get('/empleados',[ArchivoController::class, 'empleados'])->name('empleados');
    Route::get('/docsEmpleados/{empleado}',[ArchivoController::class, 'verDocsEmpleados'])->name('verDocsEmpleados');
    Route::view('/mapa-fichajes', 'admin.mapa')->name('mapa');
    //Parte de exportar CSV-----------------------------------------------------------
    Route::get('/exportar-csv', [HorarioGeneralController::class, 'exportarCSV'])->name('exportarCSV');
});

// Rutas para el empleado
Route::middleware(['rol:employee'])->group(function () {
    Route::get('/employee/dashboard', [EmployeeController::class, 'dashboard'])->name('employee.dashboard');
    Route::get('/employee/dashboard/horarios',[RegistroController::class, 'index'])->name('employee.horarios');
    Route::get('/employee-fichar', function(){return view('employee.fichar');})->name('fichar-employee');
    Route::view('/solicitud-form', 'employee.solicitud')->name('solicitud');
    Route::post('/hacer-solicitud', [SolicitudController::class, 'create'])->name('hacer.solicitud');
    Route::get('/admin_docs', [ArchivoController::class, 'adminDocs'])->name('adminDocs');
});

Route::get('/mis_docs', [ArchivoController::class, 'verMisDocs'])->name('misDocs');
Route::get('/empleados/subir-archivo', [ArchivoController::class, 'mostrarFormulario'])
->name('archivo.formulario');
Route::view('/documentos', 'ver_docs')->name('documentos');
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
