<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use App\Models\Categoria;
use Illuminate\Support\Str;

new #[Layout('layouts.app')] class extends Component {
    //variables del modelo
    public $nombre;

    public function save()
    {
        $this->nombre = Str::lower($this->nombre);
        
        $this->validate([
            'nombre' => 'required|min:3|max:30|unique:categorias'
        ]);

        Categoria::create([
            'nombre' => $this->nombre,
        ]);

        return $this->redirect('/categorias', navigate: true);
    }
}; ?>

<div>
    @slot('header')
        <h1 class="font-bold">Categorias > create</h1>
    @endslot

    <x-layout-form title="Crear categoria">
        @include('forms.categoria-form')

        <div class="flex justify-end gap-2">
            
            <x-secondary-button href="{{ route('categorias.index') }}" wire:navigate>Cancelar</x-secondary-button>
            <x-primary-button>Guardar</x-primary-button>
        </div>
    </x-layout-form>
</div>
