

<div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">

    <div>
        <div>
            <label for="equipo_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Equipo:</label>
            <select id="equipo_id" wire:model="equipo_id" name="equipo_id"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option value="">Selecciona</option>
                @foreach ($equipos as $equipo)
                    <option value="{{ $equipo->id }}" @selected($equipo_id == $equipo->id)>{{ $equipo->descripcion }}
                    </option>
                @endforeach
            </select>
        </div>
        <x-primary-button wire:click="agregar">Agregar</x-primary-button>
    </div>

    <div>

    </div>
</div>
