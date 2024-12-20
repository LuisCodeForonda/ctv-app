<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ComponenteController;
use App\Http\Controllers\EquipoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\MarcasController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\ResponsableController;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

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

Route::view('/', 'welcome');

Route::middleware(['auth'])->group(function () {

    Route::get('dashboard', [HomeController::class, 'index'])->middleware(['verified'])->name('dashboard');

    Route::view('profile', 'profile')->name('profile');

    Volt::route('/usuarios', 'usuarios.index')->middleware('can:user')->name('usuarios.index');
    Volt::route('/usuarios/create', 'usuarios.create')->middleware('can:user')->name('usuarios.create');
    Volt::route('/usuarios/{usuario}/edit', 'usuarios.edit')->middleware('can:user')->name('usuarios.edit');

    Volt::route('/roles', 'roles.index')->middleware(['can:rol'])->name('roles.index');
    Volt::route('/roles/create', 'roles.create')->middleware(['can:rol'])->name('roles.create');
    Volt::route('/roles/{role}/edit', 'roles.edit')->middleware(['can:rol'])->name('roles.edit');

    Volt::route('/marcas', 'marcas.index')->middleware(['can:marca'])->name('marcas.index');
    Volt::route('/marcas/create', 'marcas.create')->middleware(['can:marca'])->name('marcas.create');
    Volt::route('/marcas/{marca}/edit', 'marcas.edit')->middleware(['can:marca'])->name('marcas.edit');
    Route::get('/marcas/export/{format}', [MarcaController::class, 'export'])->middleware(['can:marca'])->name('marcas.export');

    Volt::route('/categorias', 'categorias.index')->middleware(['can:categoria'])->name('categorias.index');
    Volt::route('/categorias/create', 'categorias.create')->middleware(['can:categoria'])->name('categorias.create');
    Volt::route('/categorias/{categoria}/edit', 'categorias.edit')->middleware(['can:categoria'])->name('categorias.edit');
    Route::get('/categorias/export/{format}', [CategoriaController::class, 'export'])->middleware(['can:categoria'])->name('categorias.export');
    
    Volt::route('/responsables', 'responsables.index')->middleware(['can:responsable'])->name('responsables.index');
    Volt::route('/responsables/create', 'responsables.create')->middleware(['can:responsable'])->name('responsables.create');
    Volt::route('/responsables/{responsable}/edit', 'responsables.edit')->middleware(['can:responsable'])->name('responsables.edit');
    Route::get('/responsables/export/{format}', [ResponsableController::class, 'export'])->middleware(['can:responsable'])->name('responsables.export');

    Volt::route('/equipos', 'equipos.index')->middleware(['can:equipo'])->name('equipos.index');
    Volt::route('/equipos/create', 'equipos.create')->middleware(['can:equipo'])->name('equipos.create');
    Volt::route('/equipos/{slug}', 'equipos.show')->middleware(['can:equipo'])->name('equipos.show');
    Volt::route('/equipos/{equipo}/edit', 'equipos.edit')->middleware(['can:equipo'])->name('equipos.edit');
    Route::get('/equipos/{equipo}/pdf', [PdfController::class, 'equipo'])->middleware(['can:equipo'])->name('equipos.pdf');
    Route::get('/equipos/export/{format}', [EquipoController::class, 'export'])->middleware(['can:equipo'])->name('equipos.export');

    Volt::route('/componentes', 'componentes.index')->middleware(['can:componente'])->name('componentes.index');
    Volt::route('/componentes/create', 'componentes.create')->middleware(['can:componente'])->name('componentes.create');
    Volt::route('/componentes/{componente}/edit', 'componentes.edit')->middleware(['can:componente'])->name('componentes.edit');
    Route::get('/componentes/export/{format}', [ComponenteController::class, 'export'])->middleware(['can:componente'])->name('componentes.export');

    Volt::route('/asignaciones', 'asignaciones.index')->middleware(['can:asignacion'])->name('asignaciones.index');
    Volt::route('/asignaciones/create', 'asignaciones.create')->middleware(['can:asignacion'])->name('asignaciones.create');
    Volt::route('/asignaciones/{user}/edit', 'asignaciones.edit')->middleware(['can:asignacion'])->name('asignaciones.edit');
    Route::get('/asignaciones/{user}/pdf', [PdfController::class, 'usuario_equipo'])->middleware(['can:asignacion'])->name('asignaciones.pdf');

    Volt::route('/mantenimientos', 'mantenimientos.index')->middleware(['can:mantenimiento'])->name('mantenimientos.index');
    Volt::route('/mantenimientos/create', 'mantenimientos.create')->middleware(['can:mantenimiento'])->name('mantenimientos.create');
    Volt::route('/mantenimientos/{slug}/create', 'mantenimientos.createone')->middleware(['can:mantenimiento'])->name('mantenimientos.createone');
    Route::get('/mantenimientos/{mantenimiento}/pdf', [PdfController::class, 'mantenimiento'])->middleware(['can:mantenimiento'])->name('mantenimientos.pdf');

    Volt::route('/reportes', 'reportes.index')->middleware(['can:reporte'])->name('reportes.index');
    Route::get('/reportes/{reporte}/pdf', [PdfController::class, 'reporte'])->middleware(['can:reporte'])->name('reportes.pdf');

    Volt::route('/equipamiento', 'equipamiento.index')->middleware(['can:equipamiento'])->name('equipamiento.index');

    Volt::route('/solicitudes', 'solicitudes.index')->middleware(['can:solititud'])->name('solicitudes.index');
    Route::get('/solicitudes/{solicitud}/pdf', [PdfController::class, 'solicitud'])->middleware(['can:solititud'])->name('solicitudes.pdf');
});

require __DIR__ . '/auth.php';
