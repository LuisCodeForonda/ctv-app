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
    public $search = '';

    public $user_id;
    public $equiposData;
    public $equiposSelected;

    public function mount()
    {
        //$this->equiposData = Equipo::where('descripcion', 'LIKE', '%' . $this->search . '%')->paginate($this->paginate);
        $this->load();
    }

    public function load()
    {
        $this->equiposData = collect(Equipo::where('estado', 2)->get());
        $this->equiposSelected = collect([]);
    }

    public function save()
    {
        $this->validate([
            'user_id' => 'required',
            'equiposSelected' => 'required'
        ]);

        $data = $this->equiposSelected->pluck('id')->toArray();
        
        $user = User::findOrFail($this->user_id);
        
        $user->equipos()->sync($data);

        return $this->redirect('/asignaciones', navigate: true);
    }

    public function agregar($id)
    {
        $equipo = $this->equiposData->where('id', $id)->first();
        if ($equipo) {
            $this->equiposSelected = $this->equiposSelected->push($equipo);
            $this->equiposData = $this->equiposData->where('id', '!=', $id);
        }
    }

    public function extraer($id)
    {
        $equipo = $this->equiposSelected->where('id', $id)->first();
        if ($equipo) {
            $this->equiposData = $this->equiposData->push($equipo);
            $this->equiposSelected = $this->equiposSelected->where('id', '!=', $id);
        }
    }

    public function with()
    {
        return [
            'users' => User::all(),
        ];
    }
}; ?>

<div>
    @slot('header')
        <h1 class="font-bold">Asignar equipos</h1>
    @endslot

    <form wire:submit="save" class='mx-auto p-4 border-1 border-gray-200 shadow-md rounded-md bg-white dark:bg-gray-800'>


        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div class="grid grid-cols-1 gap-4">

                <div>
                    <label for="equipos" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Selecciona
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
                                            <button href="#"
                                                class="font-medium text-yellow-600 dark:text-yellow-500 hover:underline">Ver</button>
                                            <button wire:click.prevent="agregar({{ $item->id }})"
                                                class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Agregar</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
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
                                        <button href="#"
                                            class="font-medium text-yellow-600 dark:text-yellow-500 hover:underline">Ver</button>
                                        <button wire:click.prevent="extraer({{ $item->id }})"
                                            class="font-medium text-red-600 dark:text-red-500 hover:underline">Extraer</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <x-input-error :messages="$errors->get('equiposSelected')" class="mt-2" />
                </div>
            </div>
        </div>

        <div class="flex justify-end gap-2">
            <x-secondary-button href="{{ route('asignaciones.index') }}" wire:navigate>Cancelar</x-secondary-button>
            <x-primary-button>Guardar</x-primary-button>
        </div>
    </form>
</div>
