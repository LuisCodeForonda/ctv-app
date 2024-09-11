<div class="grid gap-4 mb-4">
    <div>
        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre</label>
        <input type="text" name="name" wire:model="name" id="name"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
        <x-input-error :messages="$errors->get('name')" class="mt-2" />
    </div>
    <div>
        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Correo</label>
        <input type="text" name="email" wire:model="email" id="email"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
        <x-input-error :messages="$errors->get('email')" class="mt-2" />
    </div>
    <div class="grid grid-cols-2">
        <div class="flex items-center">
            <input id="checked-checkbox" name="enabled" wire:model="enabled" type="checkbox"
                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
            <label for="checked-checkbox"
                class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Habilitado</label>
        </div>
        <div>
            <label for="rol" class="block text-sm font-medium text-gray-900 dark:text-white">Asignar un rol</label>
            <select id="rol" name="rol" wire:model='rol'
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full px-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option value="">Selecciona un rol</option>
                @foreach ($roles as $rol)
                    <option value="{{ $rol->name }}" @selected($rol->name == $rol)>{{ $rol->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    @if (!isset($usuario))
    <div>
        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Contraceña</label>
        <input type="password" name="password" wire:model="password" id="password"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
        <x-input-error :messages="$errors->get('password')" class="mt-2" />
    </div>
    <div>
        <label for="password_confirmation"
            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirmar contraceña</label>
        <input type="password" name="password_confirmation" wire:model="password_confirmation"
            id="password_confirmation"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
    </div>
    @endif
    
</div>
