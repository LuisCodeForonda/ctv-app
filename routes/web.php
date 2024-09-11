<?php

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

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Volt::route('/usuarios', 'usuarios.index')->middleware(['auth'])->name('usuarios.index');
Volt::route('/usuarios/create', 'usuarios.create')->middleware(['auth'])->name('usuarios.create');
Volt::route('/usuarios/{usuario}/edit', 'usuarios.edit')->middleware(['auth'])->name('usuarios.edit');

Volt::route('/roles', 'roles.index')->middleware(['auth'])->name('roles.index');
Volt::route('/roles/create', 'roles.create')->middleware(['auth'])->name('roles.create');
Volt::route('/roles/{role}/edit', 'roles.edit')->middleware(['auth'])->name('roles.edit');

Volt::route('/marcas', 'marcas.index')->middleware(['auth'])->name('marcas.index');
Volt::route('/marcas/create', 'marcas.create')->middleware(['auth'])->name('marcas.create');
Volt::route('/marcas/{marca}/edit', 'marcas.edit')->middleware(['auth'])->name('marcas.edit');


Volt::route('/responsables', 'responsables.index')->middleware(['auth'])->name('responsables.index');
Volt::route('/responsables/create', 'responsables.create')->middleware(['auth'])->name('responsables.create');
Volt::route('/responsables/{responsable}/edit', 'responsables.edit')->middleware(['auth'])->name('responsables.edit');


Volt::route('/equipos', 'equipos.index')->middleware(['auth'])->name('equipos.index');
Volt::route('/equipos/create', 'equipos.create')->middleware(['auth'])->name('equipos.create');
Volt::route('/equipos/{equipo}/edit', 'equipos.edit')->middleware(['auth'])->name('equipos.edit');


Volt::route('/componentes', 'componentes.index')->middleware(['auth'])->name('componentes.index');
Volt::route('/componentes/create', 'componentes.create')->middleware(['auth'])->name('componentes.create');
Volt::route('/componentes/{componente}/edit', 'componentes.edit')->middleware(['auth'])->name('componentes.edit');


Volt::route('/categorias', 'categorias.index')->middleware(['auth'])->name('categorias.index');
Volt::route('/categorias/create', 'categorias.create')->middleware(['auth'])->name('categorias.create');
Volt::route('/categorias/{categoria}/edit', 'categorias.edit')->middleware(['auth'])->name('categorias.edit');


Volt::route('/noticias', 'noticias.index')->middleware(['auth'])->name('noticias.index');
Volt::route('/noticias/create', 'noticias.create')->middleware(['auth'])->name('noticias.create');
Volt::route('/noticias/{noticia}/edit', 'noticias.edit')->middleware(['auth'])->name('noticias.edit');


require __DIR__ . '/auth.php';
