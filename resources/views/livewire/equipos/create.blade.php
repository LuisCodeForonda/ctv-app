<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Str;
use App\Models\Equipo;
use App\Models\Marca;
use App\Models\Responsable;

new #[Layout('layouts.app')] class extends Component {
    //variables del modelo
    public $descripcion;
    public $observaciones;
    public $modelo;
    public $serie;
    public $serietec;
    public $estado;
    public $area;
    public $ubicacion;
    public $marca_id;
    public $responsable_id;

    public function save()
    {

        $this->validate([
            'descripcion' => 'required|min:3|max:400',
            'observaciones' => 'max:150',
            'modelo' => 'max:30',
            'serie' => 'max:50',
            'serietec' => 'required|max:50|unique:equipos',
            'estado' => 'required|numeric|min:1|max:4',
            'area' => 'max:30',
            'ubicacion' => 'max:50',
            'marca_id' => '',
            'responsable_id' => '',
        ]);

        Equipo::create([
            'descripcion' => $this->descripcion,
            'observaciones' => $this->observaciones,
            'modelo' => $this->modelo,
            'serie' => $this->serie,
            'serietec' => $this->serietec,
            'estado' => $this->estado,
            'area' => $this->area,
            'ubicacion' => $this->ubicacion,
            'slug' => Str::slug($this->serietec, '-'),
            'marca_id' => $this->marca_id,
            'responsable_id' => $this->responsable_id,
        ]);

        return $this->redirect('/equipos', navigate: true);
    }

    public function with()
    {
        return [
            'marcas' => Marca::all(),
            'responsables' => Responsable::all(),
        ];
    }
}; ?>

<div>
    @slot('header')
        <h1 class="font-bold">Equipos > create</h1>
    @endslot

    <x-layout-form title="Crear equipo">
        @include('forms.equipo-form')

        <div class="flex justify-end gap-2">
            
            <x-secondary-button href="{{ route('equipos.index') }}" wire:navigate>Cancelar</x-secondary-button>
            <x-primary-button>Guardar</x-primary-button>
        </div>
    </x-layout-form>
</div>
