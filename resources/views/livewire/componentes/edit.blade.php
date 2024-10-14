<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Str;
use App\Models\Componente;
use App\Models\Marca;

new #[Layout('layouts.app')] class extends Component {
    //objeto
    public Componente $componente;

    //variables del modelo
    public $descripcion;
    public $observaciones;
    public $modelo;
    public $serie;
    public $cantidad = 1;
    public $marca_id;
    public $equipo_id;

    public function mount(Componente $componente)
    {
        $this->fill($componente);
        $this->descripcion = $componente->descripcion;
        $this->observaciones = $componente->observaciones;
        $this->modelo = $componente->modelo;
        $this->serie = $componente->serie;
        $this->cantidad = $componente->cantidad;
        $this->marca_id = $componente->marca_id;
        $this->equipo_id = $componente->equipo_id;
    }

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

        $this->componente->update([
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
        <h1 class="font-bold">Componentes > edit</h1>
    @endslot

    <x-layout-form title="Editar componente">
        @include('forms.componente-form')

        <div class="flex justify-end gap-2">

            <x-secondary-button href="{{ route('componentes.index') }}" wire:navigate>Cancelar</x-secondary-button>
            <x-primary-button>Actualizar</x-primary-button>
        </div>
    </x-layout-form>
</div>
