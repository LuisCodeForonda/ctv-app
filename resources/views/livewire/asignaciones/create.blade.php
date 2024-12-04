<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;
use App\Models\Equipo;
use App\Models\User;

new #[Layout('layouts.app')] class extends Component {
    use WithPagination;

    //variables
    public $paginate = 10;

    public $user_id;
    //public $equiposData;
    //public $equiposSelected;
    public $show = false;
    public $equipo;

    //para filtrar datos
    public $search = ''; // Para el buscador
    public $selectedItems = [];

    public function save()
    {
        $this->validate([
            'user_id' => 'required',
            'selectedItems' => 'required|array|min:1',
        ]);

        // $data = $this->equiposSelected->pluck('id')->toArray();

        $user = User::findOrFail($this->user_id);

        //return dump(array_values($this->selectedItems));
        $user->equipos()->sync(array_values($this->selectedItems));

        return $this->redirect('/asignaciones', navigate: true);
        
    }

    // public function agregar($id)
    // {
    //     $equipo = $this->equiposData->where('id', $id)->first();
    //     if ($equipo) {
    //         $this->equiposSelected = $this->equiposSelected->push($equipo);
    //         $this->equiposData = $this->equiposData->where('id', '!=', $id);
    //     }
    // }

    // public function extraer($id)
    // {
    //     $equipo = $this->equiposSelected->where('id', $id)->first();
    //     if ($equipo) {
    //         $this->equiposData = $this->equiposData->push($equipo);
    //         $this->equiposSelected = $this->equiposSelected->where('id', '!=', $id);
    //     }
    // }

    public function view($id)
    {
        $this->equipo = Equipo::findOrFail($id);
        $this->show = true;
    }

    public function closeModal()
    {
        $this->show = false;
        $this->showDelete = false;
    }

    public function addToSelected($id)
    {
        if (!in_array($id, $this->selectedItems)) {
            $this->selectedItems[] = $id;
        }
    }

    public function removeFromSelected($id)
    {
        $this->selectedItems = array_filter($this->selectedItems, fn($item) => $item !== $id);
    }

    public function with()
    {
        return [
            'users' => User::all(),
            'equiposData' => Equipo::whereNotIn('id', $this->selectedItems)
                ->where('descripcion', 'like', '%' . $this->search . '%')
                ->where('estado', '2')
                ->paginate($this->paginate),
            'equiposSelected' => Equipo::whereIn('id', $this->selectedItems)->get(),
        ];
    }
}; ?>

<div>
    @slot('header')
        <h1 class="font-bold">Asignar equipos</h1>
    @endslot

    <form class='mx-auto p-4 border-1 border-gray-200 shadow-md rounded-md bg-white dark:bg-gray-800'>


        <div class="grid grid-cols-1 gap-4 mb-4">
            <div class="grid grid-cols-1">
                <div>
                    <label for="user_id"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Usuario</label>
                    <select id="user_id" wire:model="user_id" name="user_id"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="">Selecciona un usuario para asignar equipos</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->perfil->nombre }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('user_id')" class="mt-2" />
                </div>

                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <label for="equipos" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Equipos
                        seleccionados</label>

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
                                    <span class="sr-only">Acciones</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($equiposSelected as $item)
                                <tr wire:key="{{ $item->id }}"
                                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ Str::limit($item->descripcion, 40) }}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ $item->modelo }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $item->serie }}
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <button wire:click.prevent="view({{ $item->id }})"
                                            class="font-medium text-yellow-600 dark:text-yellow-500 hover:underline">Ver</button>
                                        <button wire:click.prevent="removeFromSelected({{ $item->id }})"
                                            class="font-medium text-red-600 dark:text-red-500 hover:underline">Extraer</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <x-input-error :messages="$errors->get('selectedItems')" class="mt-2" />
                </div>

                <div class="flex justify-end gap-2 mt-4">
                    <x-secondary-button href="{{ route('asignaciones.index') }}" wire:navigate>Cancelar</x-secondary-button>
                    <x-primary-button wire:click.prevent="save">Guardar</x-primary-button>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-4">
                <div>
                    <div class="flex gap-4">
                        <div class="flex items-center w-64 max-w-sm">
                            <label for="simple-search" class="sr-only">Search</label>
                            <div class="relative w-full">
                                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M3 5v10M3 5a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm0 10a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm12 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm0 0V6a3 3 0 0 0-3-3H9m1.5-2-2 2 2 2" />
                                    </svg>
                                </div>
                                <input type="text" wire:model.live.debounce.500ms="search" id="simple-search"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Buscar..." />
                            </div>
                        </div>
                        <div class="w-32">
                            <select id="countries" wire:model.live="paginate"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option selected value="10">10 registros</option>
                                <option value="25">25 registros</option>
                                <option value="50">50 registros</option>
                                <option value="100">100 registros</option>
                            </select>
                        </div>


                    </div>


                    <label for="equipos"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Selecciona
                        los
                        equipos</label>

                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
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
                                        <span class="sr-only">Acciones</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($equiposData as $item)
                                    <tr wire:key="{{ $item->id }}"
                                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ Str::limit($item->descripcion, 40) }}
                                        </th>
                                        <td class="px-6 py-4">
                                            {{ $item->modelo }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $item->serie }}
                                        </td>
                                        <td class="px-6 py-4 text-right">
                                            <button wire:click.prevent="view({{ $item->id }})"
                                                class="font-medium text-yellow-600 dark:text-yellow-500 hover:underline">Ver</button>
                                            <button wire:click.prevent="addToSelected({{ $item->id }})"
                                                class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Agregar</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>

                            <div>
                                {{ $equiposData->links() }}
                            </div>
                        </table>
                    </div>
                </div>
            </div>


        </div>

        
    </form>



    @if ($show)
        <x-modal-show title="Detalle del marca">
            <strong>Descripcion</strong>
            <p>{{ $equipo->descripcion }}</p>
            @if ($equipo->observaciones)
                <strong>Observaciones</strong>
                <p>{{ $equipo->observaciones }}</p>
            @endif
            @if ($equipo->modelo)
                <strong>Modelo</strong>
                <p>{{ $equipo->modelo }}</p>
            @endif
            @if ($equipo->serie)
                <strong>Serie</strong>
                <p>{{ $equipo->serie }}</p>
            @endif
            @if ($equipo->cantidad)
                <strong>cantidad</strong>
                <p>{{ $equipo->cantidad }}</p>
            @endif

            <strong>estado</strong>
            <p>
                @if ($equipo->estado == 1)
                    Stand by
                @elseif($equipo->estado == 2)
                    Operativo
                @elseif($equipo->estado == 3)
                    Mantenimiento
                @elseif($equipo->estado == 4)
                    Malo
                @endif
            </p>


            @if ($equipo->marca)
                <strong>marca</strong>
                <p>{{ $equipo->marca->nombre }}</p>
            @endif
        </x-modal-show>
    @endif
</div>
