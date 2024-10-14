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
        $this->closeModal();
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

            <div class="relative overflow-x-auto mt-2">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Nombre
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Extención
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Fecha
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Acciones
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                            <tr wire:key="{{ $item->id }}"
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $item->nombre }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $item->extension }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $item->created_at->format('d/m/Y') }}
                                </td>
                                <td class="px-6 py-4 flex gap-4">
                                    <button type="button"
                                        wire:click="download('{{ $item->file }}', '{{ $item->nombre }}')">
                                        <img src="{{ asset('icons/download.svg') }}" alt="icono descarga">
                                    </button>
                                    <button type="button" wire:click="destroy({{ $item->id }})">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor"
                                            class="size-6">
                                            <path fill-rule="evenodd"
                                                d="M16.5 4.478v.227a48.816 48.816 0 0 1 3.878.512.75.75 0 1 1-.256 1.478l-.209-.035-1.005 13.07a3 3 0 0 1-2.991 2.77H8.084a3 3 0 0 1-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 0 1-.256-1.478A48.567 48.567 0 0 1 7.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 0 1 3.369 0c1.603.051 2.815 1.387 2.815 2.951Zm-6.136-1.452a51.196 51.196 0 0 1 3.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 0 0-6 0v-.113c0-.794.609-1.428 1.364-1.452Zm-.355 5.945a.75.75 0 1 0-1.5.058l.347 9a.75.75 0 1 0 1.499-.058l-.346-9Zm5.48.058a.75.75 0 1 0-1.498-.058l-.347 9a.75.75 0 0 0 1.5.058l.345-9Z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
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
            <p class="mb-4">{{ $archivo->nombre }}</p>
        </x-modal-destroy-confirm>
    @endif

</div>
