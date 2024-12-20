<?php

use Livewire\Volt\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\Mantenimiento;

new class extends Component {
    public $equipo;

    //variables del modelo
    public $descripcion;
    public $equipo_id;
    public $user_id;
    public $mantenimiento;

    //variables generales
    public $isOpen = false;
    public $showDeleteModal = false;
    public $show = false;

    //funciones
    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->show = false;
        $this->showDeleteModal = false;
        $this->reset('descripcion', 'equipo_id', 'user_id', 'mantenimiento');
        $this->resetValidation();
    }

    public function openConfirmModal()
    {
        $this->showDeleteModal = true;
    }

    public function closeConfimModal()
    {
        $this->showDeleteModal = false;
        $this->reset('descripcion', 'equipo_id', 'user_id', 'mantenimiento');
    }

    public function save()
    {
        //$this->descripcion = Str::of($this->descripcion)->trim();

        $this->validate([
            'tipo' => 'required',
            'descripcion' => ['required', 'max:400'],
        ]);

        Mantenimiento::updateOrCreate(
            ['id' => $this->mantenimiento],
            [
                'tipo' => $this->tipo,
                'descripcion' => $this->descripcion,
                'equipo_id' => $this->equipo->id,
                'user_id' => Auth::user()->id,
            ],
        );

        $this->closeModal();
    }

    public function view($id)
    {
        $mantenimiento = Mantenimiento::findOrFail($id);
        $this->mantenimiento = $mantenimiento;
        $this->show = true;
    }

    public function edit($id)
    {
        $this->mantenimiento = Mantenimiento::findOrFail($id);
        $this->tipo = $this->mantenimiento->tipo;
        $this->descripcion = $this->mantenimiento->descripcion;
        $this->isOpen = true;
    }

    public function destroy($id)
    {
        $this->mantenimiento = Mantenimiento::findOrFail($id);
        $this->showDeleteModal = true;
    }

    public function confirmDestroy()
    {
        $this->mantenimiento->delete();
        session()->flash('message', 'Eliminado Exitosamente.');
        $this->showDeleteModal = false;
    }

    public function with()
    {
        return [
            'data' => Mantenimiento::where('equipo_id', $this->equipo->id)
                ->latest()
                ->get(),
        ];
    }
}; ?>

<div class="py-2 border-t-2">
    <h1 class="text-xl font-bold mb-2">Historial de mantenimientos</h1>

    <div class="mt-2">
        @if ($data->isEmpty())
            <div class="text-center mt-4">
                <p class="mb-4">Aún no tienes registros</p>
                <x-primary-button wire:click="openModal">Agregar nuevo</x-primary-button>
            </div>
        @else
            <div>
                {{-- <x-primary-button wire:click="openModal">Nuevo</x-primary-button> --}}


                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 mt-2">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Codigo
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Descripcion
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Tecnico
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
                                <td class="px-6 py-4">
                                    {{ $item->id }}
                                </td>
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $item->descripcion }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $item->user->name }}
                                </td>
                                <td class="px-6 py-4 flex gap-4">
                                    <button wire:click="view({{ $item->id }})"
                                        class="font-medium text-yellow-500 dark:text-yellow-500 hover:underline">
                                        Show
                                    </button>
                                    <a href="{{ route('mantenimientos.pdf', $item->id)}}"
                                        class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Imprimir reporte</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        @endif
    </div>

    @if ($isOpen)
        <x-modal-show title="Registrar un nuevo mantenimiento">
            <form wire:submit="save">
                @include('forms.mantenimiento-form')
                <div class="flex justify-end gap-2">
                    <x-secondary-button wire:click="closeModal">Cancelar</x-secondary-button>
                    <x-primary-button
                        wire:click="save">{{ $mantenimiento ? 'Actualizar' : 'Guardar' }}</x-primary-button>
                </div>
            </form>
        </x-modal-show>
    @endif

    @if ($showDeleteModal)
        <x-modal-destroy-confirm>
            <p class="mb-4">{{ $mantenimiento->descripcion }}</p>
        </x-modal-destroy-confirm>
    @endif

    @if ($show)
        <x-modal-show title="Detalle del mantenimiento">
            <strong>Descripcion general</strong>
            <p>{{ $mantenimiento->descripcion }}</p>
            <strong>Tecnico</strong>
            <p>{{ $mantenimiento->user->name }}</p>
            <strong>Fecha</strong>
            <p>{{ $mantenimiento->created_at }}</p>

            <strong>Detalle del mantenimiento</strong>
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3 bg-gray-50 dark:bg-gray-800">
                                Tipo
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Descripcion
                            </th>
                            <th scope="col" class="px-6 py-3 bg-gray-50 dark:bg-gray-800">
                                Precio
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($mantenimiento->detalle as $item)
                        <tr class="border-b border-gray-200 dark:border-gray-700">
                            <td class="px-4 py-1 bg-gray-50 dark:bg-gray-800">
                                {{ config('constants.tipo')[$item->tipo] }}
                            </td>
                            <th scope="row"
                                class="px-4 py-1 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
                                {{ $item->descripcion }}
                            </th>
                            <td class="px-4 py-1">
                                {{ $item->costo }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>


            
        </x-modal-show>
    @endif

</div>
