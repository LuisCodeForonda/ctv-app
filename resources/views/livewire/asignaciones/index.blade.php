<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;
use Illuminate\Support\Str;
use App\Models\Equipo;
use App\Models\User;
use App\Models\Marca;
use App\Models\Categoria;
use App\Models\UserEquipo;

new #[Layout('layouts.app')] class extends Component {
    use WithPagination;

    //variables de pagina
    public $paginate = 10;
    public $search = '';
    public $show = false;
    public $showDelete = false;
    public $usuario;

    //ordenar
    public $sortBy = 'created_at';
    public $sortDir = 'DESC';

    //funciones
    public function view($id)
    {
        $this->usuario = User::findOrFail($id);
        $this->show = true;
    }

    public function destroy($id)
    {
        $this->usuario = User::findOrFail($id);
        $this->showDelete = true;
    }

    public function confirmDestroy()
    {
        $this->usuario->delete();
        session()->flash('message', 'Eliminado Exitosamente.');
        $this->showDelete = false;
    }

    public function closeModal()
    {
        $this->reset('usuario');
        $this->show = false;
        $this->showDelete = false;
    }

    public function setSortBy($sort)
    {
        if ($this->sortBy === $sort) {
            $this->sortDir = $this->sortDir == 'ASC' ? 'DESC' : 'ASC';
            return;
        }
        $this->sortBy = $sort;
        $this->sortDir = 'DESC';
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function with()
    {
        return [
            'data' => User::has('equipos')->get(),
            // 'data' => User::where('name', 'LIKE', '%' . $this->search . '%')
            //     ->orderBy($this->sortBy, $this->sortDir)
            //     ->paginate($this->paginate),
        ];
    }
}; ?>

<div>
    @slot('header')
        <h1 class="font-bold">Usuarios</h1>
    @endslot

    @if ($data->isEmpty())
        <div class="text-center mt-8">
            <p class="mb-4 text-2xl">Aún no hay registros</p>
            <x-primary-button href="{{ route('asignaciones.create') }}" wire:navigate>Nuevo</x-primary-button>
        </div>
    @else
        <x-primary-button href="{{ route('asignaciones.create') }}" wire:navigate>Nuevo</x-primary-button>
        <div class="flex flex-row justify-between items-center py-2">

            <div class="flex items-center w-64 max-w-sm">
                <label for="simple-search" class="sr-only">Search</label>
                <div class="relative w-full">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 5v10M3 5a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm0 10a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm12 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm0 0V6a3 3 0 0 0-3-3H9m1.5-2-2 2 2 2" />
                        </svg>
                    </div>
                    <input type="text" wire:model.live.debounce.500ms="search" id="simple-search"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Buscar..." />
                </div>
            </div>
            <div class="w-32">
                <select id="countries" wire:model.live="paginate"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option selected value="10">10 registros</option>
                    <option value="25">25 registros</option>
                    <option value="50">50 registros</option>
                    <option value="100">100 registros</option>
                </select>
            </div>

        </div>


        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">

                <tbody>
                    <div>
                        @foreach ($data as $item)
                            <div class="p-2">
                                <div class="flex gap-4 flex-wrap">
                                    <p>Nombre: {{ $item->perfil->nombre }}</p>
                                    <p>Carnet: {{ $item->perfil->carnet }} </p>
                                    <p>Cargo: {{ $item->perfil->cargo }} </p>
                                    <p>Celular: {{ $item->perfil->celular }} </p>
                                </div>
                                <div class="flex gap-4">
                                    <a href="{{ route('asignaciones.edit', $item) }}" wire:navigate
                                        class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Actualizar sus
                                        equipos</a>
                                    <a href="{{ route('asignaciones.pdf', $item->id) }}"
                                        class="font-medium text-yellow-600 dark:text-yellow-500 hover:underline">Generar
                                        reporte</a>
                                </div>


                                <h2>Equipos Asignados</h2>

                                <div class="relative overflow-x-auto">
                                    <table
                                        class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                        <thead
                                            class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                                            <tr>
                                                <th scope="col" class="px-6 py-3 ">
                                                    Descripcion
                                                </th>
                                                <th scope="col" class="px-6 py-3">
                                                    Modelo
                                                </th>
                                                <th scope="col" class="px-6 py-3 ">
                                                    Serie
                                                </th>
                                                <th scope="col" class="px-6 py-3 ">
                                                    Fecha asignacion
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($item->asignados as $item)
                                                <tr class="bg-white dark:bg-gray-800">
                                                    <th scope="row"
                                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                        {{ Str::limit($item->equipo->descripcion, 50) }}
                                                    </th>
                                                    <td class="px-6 py-4">
                                                        {{ $item->equipo->modelo }}
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        {{ $item->equipo->serie }}
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        {{ $item->fecha_asignacion }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr class="font-semibold text-gray-900 dark:text-white">
                                                <th scope="row" class="px-6 py-3 text-base">Total</th>
                                                <td class="px-6 py-3">3</td>
                                                <td class="px-6 py-3">21,000</td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>

                            </div>
                            <hr>
                        @endforeach
                    </div>

                </tbody>

            </table>
            <div class="py-2">

            </div>
        </div>
    @endif
</div>
