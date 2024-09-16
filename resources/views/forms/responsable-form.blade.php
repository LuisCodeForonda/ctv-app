<div class="grid gap-4 mb-4">
    <div>
        <label for="nombre" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre</label>
        <input type="text" name="nombre" wire:model="nombre" id="nombre"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            required />
        <x-input-error :messages="$errors->get('nombre')" class="mt-2" />
    </div>
    <div>
        <label for="cargo" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Cargo</label>
        <input type="text" name="cargo" wire:model="cargo" id="cargo"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
        <x-input-error :messages="$errors->get('cargo')" class="mt-2" />
    </div>
    <div>
        <label for="carnet" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Carnet</label>
        <input type="text" name="carnet" wire:model="carnet" id="carnet"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
        <x-input-error :messages="$errors->get('carnet')" class="mt-2" />
    </div>
    <div>
        <label for="celular" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Celular</label>
        <input type="text" name="celular" wire:model="celular" id="area"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
        <x-input-error :messages="$errors->get('celular')" class="mt-2" />
    </div>
</div>
