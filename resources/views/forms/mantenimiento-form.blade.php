<div class="grid gap-4 mb-4">
    <div>
        <label for="tipo" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tipo</label>
        <select id="tipo" wire:model="tipo" name="tipo"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            <option value="">Selecciona un opcion</option>
            @foreach (config('constants.tipo') as $key => $value)
                <option value="{{ $key }}" @selected($tipo == $key)>{{ $value }}</option>
            @endforeach
        </select>
        <x-input-error :messages="$errors->get('tipo')" class="mt-2" />
    </div>
    <div>
        <label for="descripcion" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Descripcion</label>
        <textarea id="descripcion" wire:model="descripcion" name="descripcion" rows="4"
            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            placeholder="Write your thoughts here..."></textarea>
        <x-input-error :messages="$errors->get('descripcion')" class="mt-2" />
    </div>
</div>
