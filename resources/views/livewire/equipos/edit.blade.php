<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Str;
use App\Models\Equipo;
use App\Models\Marca;
use App\Models\Responsable;

new #[Layout('layouts.app')] class extends Component {
    //objeto
    public Equipo $equipo;

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

    public function mount(Equipo $equipo)
    {
        $this->fill($equipo);
        $this->descripcion = $equipo->descripcion;
        $this->observaciones = $equipo->observaciones;
        $this->modelo = $equipo->modelo;
        $this->serie = $equipo->serie;
        $this->cantidad = $equipo->cantidad;
        $this->estado = $equipo->estado;
        $this->area = $equipo->area;
        $this->ubicacion = $equipo->ubicacion;
        $this->marca_id = $equipo->marca_id;
        $this->responsable_id = $equipo->responsable_id;
    }

    public function save()
    {

        $this->validate([
            'descripcion' => 'required|min:3|max:400',
            'observaciones' => 'max:150',
            'modelo' => 'max:30',
            'serie' => 'max:50',
            'estado' => 'required|numeric|min:1|max:4',
            'area' => '',
            'ubicacion' => '',
            'marca_id' => '',
            'responsable_id' => '',
        ]);

        $this->equipo->update([
            'descripcion' => $this->descripcion,
            'observaciones' => $this->observaciones,
            'modelo' => $this->modelo,
            'serie' => $this->serie,
            'estado' => $this->estado,
            'area' => $this->area,
            'ubicacion' => $this->ubicacion,
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
        <h1 class="font-bold">Equipos > edit</h1>
    @endslot

    <x-layout-form title="Editar equipo">
        @include('forms.equipo-form')

        <div class="flex justify-end gap-2">
            <x-secondary-button href="{{ route('equipos.index') }}" wire:navigate>Cancelar</x-secondary-button>
            <x-primary-button>Actualizar</x-primary-button>
        </div>
    </x-layout-form>
</div>
