<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use App\Models\Equipo;
use App\Models\User;
use App\Models\Marca;
use App\Models\Categoria;

new #[Layout('layouts.app')] class extends Component {

    //variables del modelo
    public $reponsable_id;
    public $equipo_id;
    public $fecha_asignacion;

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

    <x-layout-form title="Crear equipo">
        @include('forms.asignar-form')

        <div class="flex justify-end gap-2">
            
            <x-secondary-button href="{{ route('equipos.index') }}" wire:navigate>Cancelar</x-secondary-button>
            <x-primary-button>Guardar</x-primary-button>
        </div>
    </x-layout-form>
</div>
