<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use App\Models\Equipo;
use App\Models\User;
use App\Models\Marca;
use App\Models\Categoria;

new #[Layout('layouts.app')] class extends Component {

    public $isAsignar;

    //variables del modelo
    public $reponsable_id;
    public $equipo_id;
    public $fecha_asignacion;

    public $usuarios = [];
    public $equipos = [];

    public function save()
    {

        $this->validate([
            'responsable_id' => 'required|numeric',
            'equipo_id' => 'required|numeric',
            'fecha_asignacion' => 'required|date'
        ]);

        return $this->redirect('/equipos', navigate: true);
    }

    public function agregar(){
        
    }

    public function with()
    {
        return [
            'users' => User::all(),
            'equipos' => Equipo::all(),
            'marcas' => Marca::all(),
            'categorias' => Categoria::all(),
        ];
    }
}; ?>

<div>
    @slot('header')
        <h1 class="font-bold">Asignar equipo > create</h1>
    @endslot

    <form wire:submit="save" class='mx-auto p-4 border-1 border-gray-200 shadow-md rounded-md bg-white dark:bg-gray-800'>
        <h2 class="mb-2 font-bold">Asignacion de equipos</h2>
       
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">

            <div>
                <div>
                    <label for="equipo_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Equipo:</label>
                    <select id="equipo_id" wire:model="equipo_id" name="equipo_id"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="">Selecciona</option>
                        @foreach ($equipos as $equipo)
                            <option value="{{ $equipo->id }}" @selected($equipo_id == $equipo->id)>{{ $equipo->descripcion }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <x-primary-button wire:click="agregar">Agregar</x-primary-button>
            </div>
        
            <div>
        
            </div>
        </div>
        
        <div class="flex justify-end gap-2">
            <x-secondary-button href="{{ route('equipos.index') }}" wire:navigate>Cancelar</x-secondary-button>
            <x-primary-button>Guardar</x-primary-button>
        </div>
    </form>
</div>
