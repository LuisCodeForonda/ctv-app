<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ComponenteController;
use App\Http\Controllers\EquipoController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\MarcasController;
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

    Route::view('dashboard', 'dashboard')->middleware(['verified'])->name('dashboard');

    Route::view('profile', 'profile')->name('profile');

    Volt::route('/usuarios', 'usuarios.index')->middleware(['can:user index'])->name('usuarios.index');
    Volt::route('/usuarios/create', 'usuarios.create')->middleware(['can:user create'])->name('usuarios.create');
    Volt::route('/usuarios/{usuario}/edit', 'usuarios.edit')->middleware(['can:user edit'])->name('usuarios.edit');

    Volt::route('/roles', 'roles.index')->middleware(['can:rol index'])->name('roles.index');
    Volt::route('/roles/create', 'roles.create')->middleware(['can:rol create'])->name('roles.create');
    Volt::route('/roles/{role}/edit', 'roles.edit')->middleware(['can:rol edit'])->name('roles.edit');

    Volt::route('/marcas', 'marcas.index')->middleware(['can:marca index'])->name('marcas.index');
    Volt::route('/marcas/create', 'marcas.create')->middleware(['can:marca create'])->name('marcas.create');
    Volt::route('/marcas/{marca}/edit', 'marcas.edit')->middleware(['can:marca edit'])->name('marcas.edit');
    Route::get('/marcas/export/{format}', [MarcaController::class, 'export'])->middleware(['can:marca export'])->name('marcas.export');

    Volt::route('/responsables', 'responsables.index')->middleware(['can:responsable index'])->name('responsables.index');
    Volt::route('/responsables/create', 'responsables.create')->middleware(['can:responsable create'])->name('responsables.create');
    Volt::route('/responsables/{responsable}/edit', 'responsables.edit')->middleware(['can:responsable edit'])->name('responsables.edit');
    Route::get('/responsables/export/{format}', [ResponsableController::class, 'export'])->middleware(['can:responsable export'])->name('responsables.export');

    Volt::route('/equipos', 'equipos.index')->middleware(['can:equipo index'])->name('equipos.index');
    Volt::route('/equipos/create', 'equipos.create')->middleware(['can:equipo create'])->name('equipos.create');
    Volt::route('/equipos/{slug}', 'equipos.show')->middleware(['can:equipo show'])->name('equipos.show');
    Volt::route('/equipos/{equipo}/edit', 'equipos.edit')->middleware(['can:equipo edit'])->name('equipos.edit');
    Route::get('/equipos/export/{format}', [EquipoController::class, 'export'])->middleware(['can:equipo export'])->name('equipos.export');

    Volt::route('/componentes', 'componentes.index')->middleware(['can:componente index'])->name('componentes.index');
    Volt::route('/componentes/create', 'componentes.create')->middleware(['can:componente create'])->name('componentes.create');
    Volt::route('/componentes/{componente}/edit', 'componentes.edit')->middleware(['can:componente edit'])->name('componentes.edit');
    Route::get('/componentes/export/{format}', [ComponenteController::class, 'export'])->middleware(['can:componente export'])->name('componentes.export');

    Volt::route('/categorias', 'categorias.index')->middleware(['can:categoria index'])->name('categorias.index');
    Volt::route('/categorias/create', 'categorias.create')->middleware(['can:categoria create'])->name('categorias.create');
    Volt::route('/categorias/{categoria}/edit', 'categorias.edit')->middleware(['can:categoria edit'])->name('categorias.edit');
    Route::get('/categorias/export/{format}', [CategoriaController::class, 'export'])->middleware(['can:categoria export'])->name('categorias.export');

    Volt::route('/noticias', 'noticias.index')->middleware(['can:noticia index'])->name('noticias.index');
    Volt::route('/noticias/create', 'noticias.create')->middleware(['can:noticia create'])->name('noticias.create');
    Volt::route('/noticias/{noticia}/edit', 'noticias.edit')->middleware(['can:noticia edit'])->name('noticias.edit');
});

require __DIR__ . '/auth.php';
