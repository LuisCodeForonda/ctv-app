<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Str;
use App\Models\Componente;
use App\Models\Marca;

new #[Layout('layouts.app')] class extends Component {
    //variables del modelo
    public $descripcion;
    public $observaciones;
    public $modelo;
    public $serie;
    public $cantidad = 1;
    public $marca_id;
    public $equipo_id;

    public function save()
    {
        $this->validate([
            'descripcion' => 'required|min:3|max:400',
            'observaciones' => 'max:150',
            'modelo' => 'max:30',
            'serie' => 'max:50',
            'cantidad' => 'required|numeric|min:1',
            'marca_id' => '',
            'equipo_id' => '',
        ]);

        Componente::create([
            'descripcion' => $this->descripcion,
            'observaciones' => $this->observaciones,
            'modelo' => $this->modelo,
            'serie' => $this->serie,
            'cantidad' => $this->cantidad,
            'marca_id' => $this->marca_id,
            'equipo_id' => $this->equipo_id,
        ]);

        return $this->redirect('/componentes', navigate: true);
    }

    public function with(){
        return [
            'marcas' => Marca::all()
        ];
    }
}; ?>

<div>
    @slot('header')
        <h1 class="font-bold">Componentes > create</h1>
    @endslot

    <h1 class="text-center">Formulario</h1>
    <x-layout-form>
        @include('forms.componente-form')

        <div class="flex justify-end gap-2">

            <x-secondary-button href="{{ route('componentes.index') }}" wire:navigate>Cancelar</x-secondary-button>
            <x-primary-button>Guardar</x-primary-button>
        </div>
    </x-layout-form>
</div>
