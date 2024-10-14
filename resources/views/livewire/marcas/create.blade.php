<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use App\Models\Marca;
use Illuminate\Support\Str;

new #[Layout('layouts.app')] class extends Component {
    //variables del modelo
    public $nombre;

    public function save()
    {
        $this->nombre = Str::lower($this->nombre);

        $this->validate([
            'nombre' => 'required|min:2|max:30|unique:marcas'
        ]);

        Marca::create([
            'nombre' => $this->nombre,
        ]);

        $this->reset('nombre');

        return $this->redirect('/marcas', navigate: true);
    }
}; ?>

<div>
    @slot('header')
        <h1 class="font-bold">Marcas > create</h1>
    @endslot

    <x-layout-form title="Crear marca">
        @include('forms.marca-form')

        <div class="flex justify-end gap-2">
            
            <x-secondary-button href="{{ route('marcas.index') }}" wire:navigate>Cancelar</x-secondary-button>
            <x-primary-button>Guardar</x-primary-button>
        </div>
    </x-layout-form>
</div>
