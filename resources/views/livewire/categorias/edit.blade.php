<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use App\Models\Categoria;


new #[Layout('layouts.app')] class extends Component {
    //objeto
    public Categoria $categoria;

    //variables del modelo
    public $nombre;

    public function mount(Categoria $categoria)
    {
        $this->fill($categoria);
        $this->nombre = $categoria->nombre;
    }

    public function save()
    {

        $this->validate([
            'nombre' => 'required|min:3|max:30|unique:categorias',
        ]);

        $this->categoria->update([
            'nombre' => $this->nombre,
        ]);

        $this->reset('nombre');

        return $this->redirect('/categorias', navigate: true);
    }
}; ?>

<div>
    @slot('header')
        <h1 class="font-bold">Categorias > edit</h1>
    @endslot

    <h1 class="text-center">Formulario</h1>
    <x-layout-form>
        @include('forms.categoria-form')

        <div class="flex justify-end gap-2">
            <x-secondary-button href="{{ route('categorias.index') }}" wire:navigate>Cancelar</x-secondary-button>
            <x-primary-button>Actualizar</x-primary-button>
        </div>
    </x-layout-form>
</div>
