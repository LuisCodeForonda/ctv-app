<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;
use App\Models\Equipo;
use App\Models\User;

new #[Layout('layouts.app')] class extends Component {
    use WithPagination;
    //objeto user
    public User $user;

    //variables del modelo
    public $name;
    public $nombreCompleto;
    public $carnet;

    public $user_id;
    public $equipo_id;
    public $fecha_asignacion;

    //variables de pagina
    public $paginate = 10;
    public $search = '';
    public $show = false;
    public $showDelete = false;
    public $equipo;

    //ordenar
    public $sortBy = 'created_at';
    public $sortDir = 'DESC';

    //listas
    public $equiposData;
    public $equiposSelected;

    public function mount(User $user)
    {
        $this->fill($user);

        $this->name = $user->name;
        $this->nombreCompleto = $user->perfil->nombre;
        $this->carnet = $user->perfil->carnet;

        $this->equiposSelected = collect($this->user->equipos);
        $equiposIds = $this->user->equipos->pluck('id')->toArray();
        $this->equiposData = collect(Equipo::whereNotIn('id', $equiposIds)->where('estado', 2)->get());
    }

    public function setSortBy($sort)
    {
        if ($this->sortBy === $sort) {
            $this->sortDir = $this->sortDir == 'ASC' ? 'DESC' : 'ASC';
            return;
        }
        $this->sortBy = $sort;
        $this->sortDir = 'DESC';
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

    public function save()
    {
        //return dump($this->equiposAsignados);
        $data = $this->equiposSelected->pluck('id')->toArray();

        $this->user->equipos()->sync($data);

        return $this->redirect('/asignaciones', navigate: true);
    }

    public function with()
    {
        return [
            'data' => Equipo::all(),
        ];
    }
}; ?>

<div>
    @slot('header')
        <h1 class="font-bold">Actualizar su asignacion de equipos</h1>
    @endslot

    <div class="p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <a href="#">
            <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $nombreCompleto }}</h5>
        </a>
        <div class="grid grid-cols-3 gap-2">
            <p class="font-normal text-gray-700 dark:text-gray-400"><strong>email: </strong> {{ $user->email }}</p>
            <p class="font-normal text-gray-700 dark:text-gray-400"><strong>direccion: </strong> {{ $user->perfil->direccion }}</p>
            <p class="font-normal text-gray-700 dark:text-gray-400"><strong>celular: </strong> {{ $user->perfil->celular }}</p>
            <p class="font-normal text-gray-700 dark:text-gray-400"><strong>cargo: </strong> {{ $user->perfil->cargo }}</p>
            <p class="font-normal text-gray-700 dark:text-gray-400"><strong>carnet: </strong> {{ $user->perfil->carnet }}</p>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
        <div class="grid grid-cols-1 gap-4">

            <div>
                <label for="equipos" class="block mt-4 text-xl font-medium text-gray-900 dark:text-white">Equipos Disponibles</label>
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
        <div>
           
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <label for="equipos" class="block my-2 text-xl font-medium text-gray-900 dark:text-white">Equipos
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
        <x-primary-button wire:click.prevent="save">Actualizar</x-primary-button>
    </div>
    </form>
</div>
