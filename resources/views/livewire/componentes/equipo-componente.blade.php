<?php

use Livewire\Volt\Component;
use App\Models\Componente;
use App\Models\Equipo;
use App\Models\Marca;

new class extends Component {
    public $equipo;

    //atributos del modelo componentes
    public $descripcion;
    public $observaciones;
    public $modelo;
    public $serie;
    public $cantidad = 1;
    public $marca_id;
    public $equipo_id;
    public $componente;

    //variables
    public $componentes;
    public $freeComponentes;
    public $selectedComponentes;
    public $filter = '';

    //variables de los modales
    public $show = false;
    public $showDelete = false;
    public $isRegistrar = false;
    public $isAgregar = false;
    public $isExtraer = false;
    public $isEditar = false;

    public function mount($equipo)
    {
        $this->equipo = $equipo;

        $this->actualizarDatos();
    }

    public function actualizarDatos()
    {
        $this->componentes = collect(
            Componente::where('equipo_id', $this->equipo->id)
                ->latest()
                ->get(),
        );

        $this->freeComponentes = collect(
            Componente::whereNull('equipo_id')
                ->where('descripcion', 'LIKE', '%' . $this->filter . '%')
                ->get(),
        );

        $this->selectedComponentes = collect([]);
    }

    //funciones
    public function openModal($modal)
    {
        switch ($modal) {
            case 'registrar':
                $this->isRegistrar = true;
                break;
            case 'agregar':
                $this->isAgregar = true;
                break;
            case 'extraer':
                $this->isExtraer = true;
        }
    }

    public function closeModal()
    {
        $this->resetValidation();
        $this->selectedComponentes = collect([]);
        $this->reset('descripcion', 'observaciones', 'modelo', 'serie', 'cantidad', 'marca_id', 'equipo_id', 'componente');
        $this->isRegistrar = false;
        $this->isAgregar = false;
        $this->isExtraer = false;
        $this->show = false;
        $this->showDelete = false;
        $this->actualizarDatos();
    }

    //funcion para registrar un nuevo componente

    public function save()
    {
        $this->validate([
            'descripcion' => 'required',
            'observaciones' => '',
            'modelo' => 'max:30',
            'serie' => 'max:50',
            'cantidad' => 'required|numeric|min:1',
            'marca_id' => 'numeric',
        ]);

        if (!$this->componente) {
            Componente::create([
                'descripcion' => $this->descripcion,
                'observaciones' => $this->observaciones,
                'modelo' => $this->modelo,
                'serie' => $this->serie,
                'cantidad' => $this->cantidad,
                'marca_id' => $this->marca_id,
                'equipo_id' => $this->equipo->id,
            ]);
        } else {
            $this->componente->update([
                'descripcion' => $this->descripcion,
                'observaciones' => $this->observaciones,
                'modelo' => $this->modelo,
                'serie' => $this->serie,
                'cantidad' => $this->cantidad,
                'marca_id' => $this->marca_id,
                'equipo_id' => $this->equipo->id,
            ]);
        }

        $this->closeModal();
    }

    public function edit($id)
    {
        $this->componente = Componente::findOrFail($id);

        $this->descripcion = $this->componente->descripcion;
        $this->observaciones = $this->componente->observaciones;
        $this->modelo = $this->componente->modelo;
        $this->serie = $this->componente->serie;
        $this->cantidad = $this->componente->cantidad;
        $this->estado = $this->componente->estado;
        $this->marca_id = $this->componente->marca_id;
        $this->equipo_id = $this->componente->equipo_id;
        $this->isRegistrar = true;
    }

    public function view($id)
    {
        $this->componente = Componente::findOrFail($id);
        $this->show = true;
    }

    public function destroy($id)
    {
        $this->componente = Componente::findOrFail($id);
        $this->showDelete = true;
    }

    public function confirmDestroy()
    {
        $this->componente->delete();
        session()->flash('message', 'Eliminado Exitosamente.');
        $this->showDelete = false;
    }

    //funciones para agregar componentes a la lista temporal de eliminado
    public function addComponente($id)
    {
        if($this->isAgregar){
            $componente = $this->freeComponentes->where('id', $id)->first();
            if($componente){
                $this->selectedComponentes = $this->selectedComponentes->push($componente);
                $this->freeComponentes = $this->freeComponentes->where('id', '!=', $id);
            }
        }else{
            $componente = $this->componentes->where('id', $id)->first();
            if($componente){
                $this->selectedComponentes = $this->selectedComponentes->push($componente);
                $this->componentes = $this->componentes->where('id', '!=', $id);
            }
        }
    }

    //funcion para eliminar los componentes de la lista temporal
    public function removeComponente($id)
    {
        $componente = $this->selectedComponentes->where('id', $id)->first();
        if ($componente) {
            $this->selectedComponentes = $this->selectedComponentes->where('id', '!=', $id);
            if($this->isAgregar){
                $this->freeComponentes = $this->freeComponentes->push($componente);
            }else{
                $this->componentes = $this->componentes->push($componente);
            }
            
        }
    }

    //funcion encargada de guardar los cambios de las tablas
    public function saveComponents()
    {
        foreach ($this->selectedComponentes as $componente) {
            if($this->isAgregar){
                $componente->update(['equipo_id' => $this->equipo->id]);
            }else{
                $componente->update(['equipo_id' => null]);
            }
            
        }
        $this->closeModal();
        $this->actualizarDatos();
    }

    

    public function with()
    {
        return [
            'data' => Componente::where('equipo_id', $this->equipo->id)
                ->latest()
                ->get(),

            'marcas' => Marca::all(),
        ];
    }
}; ?>

<div class="py-2 border-t-2">
    <h1 class="text-xl font-bold mb-2">Componentes del equipo</h1>

    <div class="mt-2">
        @if ($data->isEmpty())
            <div class="text-center mt-4">
                <p class="mb-4">Vaya este equipo no tiene componentes</p>
                <div class="flex items-center justify-center gap-2">
                    <x-primary-button wire:click="openModal('registrar')">Registrar</x-primary-button>
                    <x-primary-button wire:click="openModal('agregar')">Agregar</x-primary-button>
                </div>

            </div>
        @else
            <x-primary-button wire:click="openModal('registrar')">Registrar</x-primary-button>
            <x-primary-button wire:click="openModal('agregar')">Agregar</x-primary-button>
            <x-primary-button wire:click="openModal('extraer')">Extraer</x-primary-button>

            <div class="relative overflow-x-auto mt-2">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Descripcion
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Modelo
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Serie
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Cantidad
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
                                    {{ $item->descripcion }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $item->modelo }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $item->serie }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $item->cantidad }}
                                </td>
                                <td class="px-6 py-4 flex gap-4">
                                    <button wire:click="view({{ $item->id }})"
                                        class="font-medium text-yellow-500 dark:text-yellow-500 hover:underline">
                                        Show
                                    </button>
                                    <button wire:click="edit({{ $item->id }})"
                                        class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Editar</button>

                                    <button wire:click="destroy({{ $item->id }})"
                                        class="font-medium text-red-500 dark:text-red-500 hover:underline">
                                        Eliminar
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    @if ($isRegistrar)
        <x-modal-show title="Registrar un nuevo componente">
            <form wire:submit="save">
                @include('forms.componente-form')
                <div class="flex justify-end gap-2">
                    <x-secondary-button wire:click="closeModal">Cancelar</x-secondary-button>
                    <x-primary-button>{{ $componente ? 'Actualizar' : 'Guardar' }}</x-primary-button>
                </div>
            </form>
        </x-modal-show>
    @endif

    @if ($isAgregar)
        <x-modal-show title="Agregar componentes" width="xl">
            <form wire:submit="saveComponents">
                <div class="grid grid-cols-1 gap-2">
                    <div>
                        <label for="descripcion"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Agregar</label>
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 mb-2">
                            <tbody>
                                @foreach ($selectedComponentes as $item)
                                    <tr wire:key="{{ $item->id }}"
                                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <th scope="row"
                                            class="py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $item->descripcion }}
                                        </th>
                                        <td class="py-2 ">
                                            {{ $item->serie }}
                                        </td>
                                        <td class="py-2 ">
                                            <button wire:click.prevent="removeComponente({{ $item->id }})"
                                                class="font-medium text-red-600 dark:text-red-500 hover:underline">Quitar</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div>
                        <label for="descripcion"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Disponibles</label>
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 mb-2">
                            <tbody>
                                @foreach ($freeComponentes as $item)
                                    <tr wire:key="{{ $item->id }}"
                                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <th scope="row"
                                            class="py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $item->descripcion }}
                                        </th>
                                        <td class="py-2">
                                            {{ $item->serie }}
                                        </td>
                                        <td class="py-2">
                                            <button wire:click.prevent="addComponente({{ $item->id }})"
                                                class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Instalar</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="flex justify-end gap-2">
                    <x-secondary-button wire:click="closeModal">Cancelar</x-secondary-button>
                    <x-primary-button>Guardar</x-primary-button>
                </div>

            </form>
        </x-modal-show>
    @endif

    @if ($isExtraer)
        <x-modal-show title="Extraer componentes" width="xl">
            <form wire:submit="saveComponents">
                <div class="grid grid-cols-1 gap-2">
                    <div>
                        <label for="descripcion"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Instalados</label>
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 mb-2">
                            <tbody>
                                @foreach ($componentes as $item)
                                    <tr wire:key="{{ $item->id }}"
                                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <th scope="row"
                                            class="py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $item->descripcion }}
                                        </th>
                                        <td class="py-2 ">
                                            {{ $item->serie }}
                                        </td>
                                        <td class="py-2 ">
                                            <button wire:click.prevent="addComponente({{ $item->id }})"
                                                class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Quitar</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div>
                        <label for="descripcion"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Extraer</label>
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 mb-2">
                            <tbody>

                                @foreach ($selectedComponentes as $item)
                                    <tr wire:key="{{ $item->id }}"
                                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <th scope="row"
                                            class="py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $item->descripcion }}
                                        </th>
                                        <td class="py-2 ">
                                            {{ $item->serie }}
                                        </td>
                                        <td class="py-2 ">
                                            <button wire:click.prevent="removeComponente({{ $item->id }})"
                                                class="font-medium text-red-600 dark:text-red-500 hover:underline">Cancelar</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>


                <div class="flex justify-end gap-2">
                    <x-secondary-button wire:click="closeModal">Cancelar</x-secondary-button>
                    <x-primary-button>Guardar</x-primary-button>
                </div>

            </form>
        </x-modal-show>
    @endif

    @if ($show)
        <x-modal-show title="Detalle del componente">
            <strong>Descripcion</strong>
            <p>{{ $componente->descripcion }}</p>
            @if ($componente->observaciones !== '')
                <strong>Observaciones</strong>
                <p>{{ $componente->observaciones }}</p>
            @endif
            @if ($componente->modelo !== '')
                <strong>Modelo</strong>
                <p>{{ $componente->modelo }}</p>
            @endif
            @if ($componente->serie !== '')
                <strong>Serie</strong>
                <p>{{ $componente->serie }}</p>
            @endif
            @if (isset($componente->cantidad))
                <strong>cantidad</strong>
                <p>{{ $componente->cantidad }}</p>
            @endif
            @if ($componente->estado !== '')
                <strong>estado</strong>
                <p>
                    @if ($componente->estado == 1)
                        Stand by
                    @elseif($componente->estado == 2)
                        Operativo
                    @elseif($componente->estado == 3)
                        Mantenimiento
                    @elseif($componente->estado == 4)
                        Malo
                    @endif
                </p>
            @endif
        </x-modal-show>
    @endif

    @if ($showDelete)
        <x-modal-destroy-confirm>
            <p class="mb-4">{{ $componente->descripcion }}</p>
        </x-modal-destroy-confirm>
    @endif
</div>
