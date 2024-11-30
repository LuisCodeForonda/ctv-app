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
    public $costo;
    public $observacion;

    //variables del funcionalidad grafica
    public $isDetalle = false;
    public $detalle = [];

    // public function mount(){
    //     $this->detalle = DetalleMantenimiento::where('mantenimiento_id', '=', '')->orWhereNull('mantenimiento_id')->get();

    //     foreach ($this->detalle as $value) {
    //         $value->delete();
    //     }
    // }

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
            # code...
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
            'costo' => '',
            'observacion' => 'max:200',
        ]);

        $detalle_mantenimiento = new DetalleMantenimiento([
            'tipo' => $this->tipo,
            'descripcion' => $this->descripcionDetalle,
            'costo' => $this->costo,
            'observacion' => $this->observacion,
        ]);
        $this->detalle [] = $detalle_mantenimiento;
        
        $this->reset('tipo', 'descripcionDetalle', 'costo', 'observacion');

        $this->isDetalle = false;
    }

    public function agregar()
    {
        $this->isDetalle = true;
    }

    public function closeModal()
    {
        $this->isDetalle = false;
    }

    public function with()
    {
        return [
            'data' => Equipo::all(),
            
        ];
    }
}; ?>

<div>
    @slot('header')
        <h1 class="font-bold">Mantenimiento > create</h1>
    @endslot

    <form class='mx-auto p-4 border-1 border-gray-200 shadow-md rounded-md bg-white dark:bg-gray-800'>
        <div class="grid grid-cols-1 md:grid-cols-1 gap-4 mb-4">
            <div>
                <label for="equipo_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Selecciona un
                    equipo</label>
                <select id="equipo_id" wire:model="equipo_id" name="equipo_id"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="">Escoge una equipo</option>
                    @foreach ($data as $equipo)
                        <option value="{{ $equipo->id }}">{{ Str::limit($equipo->descripcion, 40) }} -
                            {{ $equipo->serie }} {{ $equipo->modelo }}</option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('equipo_id')" class="mt-2" />
            </div>
            <hr>
            <div class="grid grid-cols-2 gap-4">
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
                                        Descripcion
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Modelo
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Serie
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
                                            {{ $item->tipo }}
                                        </th>
                                        <td class="px-6 py-4">
                                            {{ $item->descripcion }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $item->costo }}
                                        </td>
                                        <td class="px-6 py-4 text-right">
                                            <button wire:click.prevent="agregar({{ $item->id }})"
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
            </form>
        </x-modal-show>
    @endif
</div>
