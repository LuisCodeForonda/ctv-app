<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Str;
use App\Models\Equipo;
use App\Models\Mantenimiento;
use App\Models\DetalleMantenimiento;

new #[Layout('layouts.app')] class extends Component {
    public $tipo;
    public $descripcion;
    public $costo;
    public $observacion;
}; ?>

<div>
    @slot('header')
        <h1 class="font-bold">Mantenimiento > create > detalle</h1>
    @endslot

    <form class='mx-auto p-4 border-1 border-gray-200 shadow-md rounded-md bg-white dark:bg-gray-800'>
        <div class="grid grid-cols-1 md:grid-cols-1 gap-4 mb-4">
            <div>
                <h2>Detalle del mantenimiento</h2>
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
                    <input type="number" id="costo" wire:model="costo" name="costo"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                    <x-input-error :messages="$errors->get('costo')" class="mt-2" />
                </div>

                <div>
                    <label for="observacion"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">observacion</label>
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
        </div>
</div>




