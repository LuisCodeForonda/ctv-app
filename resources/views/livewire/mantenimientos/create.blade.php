<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Str;
use App\Models\Equipo;
use App\Models\Mantenimiento;
use App\Models\DetalleMantenimiento;

new #[Layout('layouts.app')] class extends Component {
    //variables
    public $descripcion;
    public $equipo_id;

    public $tipo;
    public $descripcionDetalle;
    public $costo = 0;
    public $observacion;
    public $equipo;

    //variables del funcionalidad grafica
    public $isDetalle = false;
    public $detalle;

    public $search = '';

    public function mount()
    {
        $this->detalle = DetalleMantenimiento::where('mantenimiento_id', '=', '')->orWhereNull('mantenimiento_id')->get();
    }

    public function save()
    {
        $this->validate([
            'descripcion' => 'required|string|max:500',
            'equipo_id' => 'required',
        ]);

        $mantenimiento = Mantenimiento::create([
            'descripcion' => $this->descripcion,
            'equipo_id' => $this->equipo_id,
            'user_id' => Auth::user()->id,
        ]);

        foreach ($this->detalle as $value) {
            $value->update([
                'mantenimiento_id' => $mantenimiento->id,
            ]);
        }

        return $this->redirect('/mantenimientos', navigate: true);
    }

    public function guardarDetalle()
    {
        $this->validate([
            'tipo' => 'required|integer',
            'descripcionDetalle' => 'required|max:200',
            'costo' => 'required|decimal:0,2',
            'observacion' => 'max:200',
        ]);

        DetalleMantenimiento::create([
            'tipo' => $this->tipo,
            'descripcion' => $this->descripcionDetalle,
            'costo' => $this->costo,
            'observacion' => $this->observacion,
        ]);

        $this->reset('tipo', 'descripcionDetalle', 'costo', 'observacion');

        $this->isDetalle = false;
    }

    public function agregar()
    {
        $this->isDetalle = true;
    }

    public function extraer($id)
    {
        $detalle = DetalleMantenimiento::findOrfail($id);
        if ($detalle) {
            $detalle->delete();
        }
    }

    public function closeModal()
    {
        $this->isDetalle = false;
    }

    public function buscar()
    {
        $this->equipo = Equipo::findOrfail($this->search);
        $this->equipo_id = $this->equipo->id;
    }

    public function with()
    {
        return [
            'data' => Equipo::all(),
            ($this->detalle = DetalleMantenimiento::where('mantenimiento_id', '=', '')->orWhereNull('mantenimiento_id')->get()),
        ];
    }
}; ?>

<div>
    @slot('header')
        <h1 class="font-bold">Mantenimiento > create</h1>
    @endslot

    <div class="max-w-96 flex gap-4 mb-4">
        <div class="flex items-center w-64 max-w-sm">
            <label for="simple-search" class="sr-only">Buscar</label>
            <div class="relative w-full">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 5v10M3 5a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm0 10a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm12 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm0 0V6a3 3 0 0 0-3-3H9m1.5-2-2 2 2 2" />
                    </svg>
                </div>
                <input type="text" wire:model="search" id="simple-search"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Codigo de equipo..." />
            </div>
        </div>

        <x-primary-button wire:click="buscar">Buscar</x-primary-button>
    </div>

    <div class="p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <a href="#">
            <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-900 dark:text-white">Detalles del equipo
            </h5>
        </a>
        <div class="grid grid-cols-3 gap-2">
            <p class="font-normal text-gray-700 dark:text-gray-400"><strong>Descripción: </strong>
                {{ $equipo->descripcion ?? '' }}</p>
            <p class="font-normal text-gray-700 dark:text-gray-400"><strong>Observacion: </strong>
                {{ $equipo->observacion ?? '' }}</p>
            <p class="font-normal text-gray-700 dark:text-gray-400"><strong>modelo: </strong>
                {{ $equipo->modelo ?? '' }}</p>
            <p class="font-normal text-gray-700 dark:text-gray-400"><strong>serie: </strong>
                {{ $equipo->serie ?? '' }}</p>
            <p class="font-normal text-gray-700 dark:text-gray-400"><strong>serietec: </strong>
                {{ $equipo->serietec ?? '' }}</p>
        </div>
    </div>

    <form class='mx-auto p-4 border-1 border-gray-200 shadow-md rounded-md bg-white dark:bg-gray-800'>
        <div class="grid grid-cols-1 md:grid-cols-1 gap-4 mb-4">


            <hr>
            <div class="grid grid-cols-1 gap-4">
                <div>
                    <h2>Descripcion general del mantenimiento</h2>
                    <div>
                        <label for="descripcion"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Descripcion</label>
                        <textarea id="descripcion" wire:model="descripcion" name="descripcion" rows="4"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Write your thoughts here..."></textarea>
                        <x-input-error :messages="$errors->get('descripcion')" class="mt-2" />
                    </div>
                </div>


                <div>
                    <h2>Detalle del mantenimiento</h2>
                    <button type="button" wire:click="agregar"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Agregar</button>

                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Tipo
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Descripcion
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Costo
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        <span class="sr-only">Acciones</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($detalle as $item)
                                    <tr
                                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ config('constants.tipo')[$item->tipo] }}
                                        </th>
                                        <td class="px-6 py-4">
                                            {{ $item->descripcion }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $item->costo }} Bs
                                        </td>
                                        <td class="px-6 py-4 text-right">
                                            <button wire:click.prevent="extraer({{ $item->id }})"
                                                class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Quitar</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>



        </div>

        <div class="flex justify-end gap-2">
            <x-secondary-button href="{{ route('mantenimientos.index') }}" wire:navigate>Cancelar</x-secondary-button>
            <x-primary-button wire:click.prevent="save">Guardar</x-primary-button>
        </div>
    </form>

    @if ($isDetalle)
        <x-modal-show title="Registrar detalle">
            <form>
                <div class="grid gap-4 mb-4">
                    <div>
                        <label for="tipo"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tipo</label>
                        <select id="tipo" wire:model="tipo" name="tipo"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="">Selecciona un opcion</option>
                            @foreach (config('constants.tipo') as $key => $value)
                                <option value="{{ $key }}" @selected($tipo == $key)>{{ $value }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('tipo')" class="mt-2" />
                    </div>
                    <div>
                        <label for="descripcion"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Descripcion</label>
                        <textarea id="descripcion" wire:model="descripcionDetalle" name="descripcion" rows="4"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Write your thoughts here..."></textarea>
                        <x-input-error :messages="$errors->get('descripcionDetalle')" class="mt-2" />
                    </div>

                    <div>
                        <label for="costo"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">costo</label>
                        <input type="number" step="0.1" id="costo" wire:model="costo" name="costo"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                        <x-input-error :messages="$errors->get('costo')" class="mt-2" />
                    </div>

                    <div>
                        <label for="observacion"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Material
                            utilizado</label>
                        <textarea id="observacion" wire:model="observacion" name="observacion" rows="4"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Write your thoughts here..."></textarea>
                        <x-input-error :messages="$errors->get('observacion')" class="mt-2" />
                    </div>
                </div>


                <div class="flex justify-end gap-2">
                    <x-secondary-button wire:click="closeModal">Cancelar</x-secondary-button>
                    <x-primary-button wire:click.prevent="guardarDetalle">Agregar</x-primary-button>
                </div>
            </form>
        </x-modal-show>
    @endif
</div>
