<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\WithFileUploads;
use App\Models\Noticia;
use App\Models\Categoria;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

new #[Layout('layouts.app')] class extends Component {
    use WithFileUploads;

    //variables del modelo
    #[Validate('required|min:3|max:50')] 
    public $titulo;

    #[Validate('required|min:100|max:500')] 
    public $body;

    #[Validate('image|max:1024')] // 1MB Max
    public $image;

    public $status = true;

    #[Validate('required')] 
    public $categoria_id;

    public function save()
    {
        $this->validate();

        $this->image = Str::substr($this->image->store('public/uploads'), 7);

        Noticia::create([
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
        <h1 class="font-bold">Noticias > create</h1>
    @endslot

    <x-layout-form title="Crear noticia">
        
        @include('forms.noticia-form')

        <div class="flex justify-end gap-2">
            <x-secondary-button href="{{ route('noticias.index') }}" wire:navigate>Cancelar</x-secondary-button>
            <x-primary-button>Guardar</x-primary-button>
        </div>
    </x-layout-form>
</div>
