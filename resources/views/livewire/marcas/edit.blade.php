<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use App\Models\Marca;

new #[Layout('layouts.app')] class extends Component {
    //objeto
    public Marca $marca;

    //variables del modelo
    public $nombre;

    public function mount(Marca $marca)
    {
        $this->fill($marca);
        $this->nombre = $marca->nombre;
    }

    public function save()
    {
        $this->nombre = Str::of($this->nombre)->trim();

        $this->validate([
            'nombre' => 'required|min:2|max:30|unique:marcas',
        ]);

        $this->marca->update([
            'nombre' => $this->nombre,
        ]);

        $this->reset('nombre');

        return $this->redirect('/marcas', navigate: true);
    }
}; ?>

<div>
    @slot('header')
        <h1 class="font-bold">Marcas > edit</h1>
    @endslot

    <h1 class="text-center">Formulario</h1>
    <x-layout-form>
        @include('forms.marca-form')

        <div class="flex justify-end gap-2">
            <x-secondary-button href="{{ route('marcas.index') }}" wire:navigate>Cancelar</x-secondary-button>
            <x-primary-button>Actualizar</x-primary-button>
        </div>
    </x-layout-form>
</div>
