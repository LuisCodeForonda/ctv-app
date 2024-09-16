<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use App\Models\Responsable;

new #[Layout('layouts.app')] class extends Component {
    //objeto
    public Responsable $responsable;

    //variables del modelo
    public $nombre;
    public $cargo;
    public $carnet;
    public $celular;

    public function mount(Responsable $responsable)
    {
        $this->fill($responsable);
        $this->nombre = $responsable->nombre;
        $this->cargo = $responsable->cargo;
        $this->carnet = $responsable->carnet;
        $this->celular = $responsable->celular;
    }

    public function save()
    {
        $this->nombre = Str::of($this->nombre)->trim();
        $this->cargo = Str::of($this->cargo)->trim();
        $this->carnet = Str::of($this->carnet)->trim();
        $this->celular = Str::of($this->celular)->trim();

        $this->validate([
            'nombre' => 'required|max:30',
            'cargo' => 'required|max:30',
            'carnet' => 'max:15',
            'celular' => 'required|max:15',
        ]);

        $this->responsable->update([
            'nombre' => $this->nombre,
            'cargo' => $this->cargo,
            'carnet' => $this->carnet,
            'celular' => $this->celular,
        ]);

        return $this->redirect('/responsables', navigate: true);
    }
}; ?>

<div>
    @slot('header')
        <h1 class="font-bold">Responsables > edit</h1>
    @endslot

    <h1 class="text-center">Formulario</h1>
    <x-layout-form>
        @include('forms.responsable-form')

        <div class="flex justify-end gap-2">
            <x-secondary-button href="{{ route('responsables.index') }}" wire:navigate>Cancelar</x-secondary-button>
            <x-primary-button>Actualizar</x-primary-button>
        </div>
    </x-layout-form>
</div>
