<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use App\Models\Responsable;
use Illuminate\Support\Str;

new #[Layout('layouts.app')] class extends Component {
    //variables del modelo
    public $nombre;
    public $cargo;
    public $carnet;
    public $celular;

    public function save()
    {

        $this->validate([
            'nombre' => 'required|max:30',
            'cargo' => 'required|max:30',
            'carnet' => 'required|max:15|unique:responsables',
            'celular' => 'required|max:15',
        ]);

        Responsable::create([
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
        <h1 class="font-bold">Responsables > create</h1>
    @endslot

    <x-layout-form title="Crear responsable">
        @include('forms.responsable-form')

        <div class="flex justify-end gap-2">

            <x-secondary-button href="{{ route('responsables.index') }}" wire:navigate>Cancelar</x-secondary-button>
            <x-primary-button>Guardar</x-primary-button>
        </div>
    </x-layout-form>
</div>
