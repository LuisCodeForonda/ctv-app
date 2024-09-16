<?php

use Livewire\Volt\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\File;
use App\Models\Archivo;

new class extends Component {
    use WithFileUploads;

    public $equipo;

    //variables del modelo
    public $archivo_id;
    public $nombre;

    #[Validate('required|max:2048')]
    public $file;
    public $extension;
    public $equipo_id;
    public $archivo;

    //variables generales
    public $isOpen = false;
    public $showDeleteModal = false;

    //funciones
    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->showDeleteModal = false;
        $this->reset('archivo_id', 'nombre', 'file', 'extension', 'equipo_id', 'archivo');
        $this->resetValidation();
    }

    public function openConfirmModal()
    {
        $this->showDeleteModal = true;
    }

    //fuciones para el crud del modelo
    public function save()
    {
        //dump("hello");
        $this->validate();

        //logica para almacenar el archivo
        $nombre = $this->file->getClientOriginalName();
        $extension = $this->file->getClientOriginalExtension();
        $file = $this->file->store('public/uploads');

        //almacenamos la imagen
        Archivo::create([
            'nombre' => $nombre,
            'file' => $file,
            'extension' => $extension,
            'equipo_id' => $this->equipo->id,
        ]);
        // foreach ($this->file as $item) {
        // }

        session()->flash('message', $this->archivo_id ? 'Actualizado Exitosamente.' : 'Creado Exitosamente.');

        $this->closeModal();
    }

    public function destroy($id)
    {
        $this->archivo = Archivo::findOrFail($id);
        $this->openConfirmModal();
    }

    public function confirmDestroy()
    {
        $archivo = Archivo::findOrFail($this->archivo->id);
        Storage::delete($archivo->file);
        $archivo->delete();
        session()->flash('message', 'Eliminado Exitosamente.');
        $this->closeConfimModal();
    }

    public function download($archivo, $name)
    {
        return Storage::download($archivo, $name);
    }

    public function with()
    {
        return [
            'data' => Archivo::where('equipo_id', $this->equipo->id)
                ->latest()
                ->get(),
        ];
    }
}; ?>

<div class="py-2 border-t-2">
    <h1 class="text-xl font-bold mb-2">Archivos del equipo</h1>

    <div class="mt-2">
        @if ($data->isEmpty())
            <div class="text-center mt-4">
                <p class="mb-4">Aún no hay archivos</p>
                <x-primary-button wire:click="openModal">Agregar nuevo</x-primary-button>
            </div>
        @else
            <x-primary-button wire:click="openModal">Nuevo</x-primary-button>

            <ul class="grid grid-cols-4 gap-2 mt-2">
                @foreach ($data as $item)
                    <li wire:key={{ $item->id }}
                        class="relative h-32 border-2 shadow-md p-2 rounded-md flex flex-col justify-between items-center ">
                        <a href="{{ Storage::url($item->file) }}"
                            class="font-medium text-blue-600 dark:text-blue-500 hover:underline">{{ $item->nombre }}</a>
                        <span class="text-4xl">{{ $item->extension }}</span>
                        <div class="flex gap-2">
                            <button type="button"
                                wire:click="download('{{ $item->file }}', '{{ $item->nombre }}')" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">descargar</button>
                            <button type="button" wire:click="destroy({{ $item->id }})" class="font-medium text-red-600 dark:text-red-500 hover:underline">eliminar</button>
                        </div>

                    </li>
                @endforeach
            </ul>
        @endif
    </div>

    @if ($isOpen)
        <x-modal-show title="Registrar un nuevo archivo" width="xl">
            <form wire:submit="save" enctype="multipart/form-data">
                @include('forms.archivo-form')
                <div class="flex justify-end gap-2">
                    <x-secondary-button wire:click="closeModal">Cancelar</x-secondary-button>
                    <x-primary-button>Guardar</x-primary-button>
                </div>
            </form>
        </x-modal-show>
    @endif

    @if ($showDeleteModal)
        <x-modal-destroy-confirm>
            {{ $archivo->nombre }}
        </x-modal-destroy-confirm>
    @endif

</div>
