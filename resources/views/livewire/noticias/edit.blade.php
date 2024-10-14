<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use App\Models\Noticia;
use App\Models\Categoria;

new #[Layout('layouts.app')] class extends Component {
    public Noticia $noticia;

    //variables del modelo
    #[Validate('required|min:3|max:50')]
    public $titulo;

    #[Validate('required|min:100|max:500')]
    public $body; // 1MB Max

    #[Validate('image|max:1024')]
    public $image;

    public $status;

    #[Validate('required')]
    public $categoria_id;

    public function mount(Noticia $noticia)
    {
        $this->fill($noticia);

        $this->titulo = $noticia->titulo;
        $this->body = $noticia->body;
        $this->image = $noticia->image;
        $this->status = $noticia->status;
        $this->categoria_id = $noticia->categoria_id;
    }

    public function save()
    {
        $this->validate();

        $this->noticia->update([
            'titulo' => $this->titulo,
            'slug' => Str::slug($this->titulo, '-'),
            'body' => $this->body,
            'image' => $this->image,
            'status' => $this->status,
            'categoria_id' => $this->categoria_id,
            'user_id' => Auth::user()->id,
        ]);

        return $this->redirect('/noticias', navigate: true);
    }

    public function with(){
        return [
            'categorias' => Categoria::all(),
        ];
    }
}; ?>

<div>
    @slot('header')
        <h1 class="font-bold">Noticias > edit</h1>
    @endslot

    <x-layout-form title="Editar noticia">
        @include('forms.noticia-form')

        <div class="flex justify-end gap-2">
            
            <x-secondary-button href="{{ route('noticias.index') }}" wire:navigate>Cancelar</x-secondary-button>
            <x-primary-button>Guardar</x-primary-button>
        </div>
    </x-layout-form>
</div>
