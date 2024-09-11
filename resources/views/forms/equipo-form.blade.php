<div class="grid gap-4 mb-4">
    <div>
        <label for="descripcion" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Descripcion</label>
        <textarea id="descripcion" wire:model="descripcion" name="descripcion" rows="4"
            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            placeholder="Write your thoughts here..."></textarea>
        <x-input-error :messages="$errors->get('descripcion')" class="mt-2" />
    </div>
    <div>
        <label for="observaciones"
            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Observaciones</label>
        <textarea id="observaciones" wire:model="observaciones" name="observaciones" rows="4"
            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            placeholder="Write your thoughts here..."></textarea>
        <x-input-error :messages="$errors->get('observaciones')" class="mt-2" />
    </div>
    <div>
        <label for="modelo" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Modelo</label>
        <input type="text" id="modelo" wire:model="modelo" name="modelo"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
        <x-input-error :messages="$errors->get('modelo')" class="mt-2" />
    </div>
    <div>
        <label for="serie" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Serie</label>
        <input type="text" id="serie" wire:model="serie" name="serie"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
        <x-input-error :messages="$errors->get('serie')" class="mt-2" />
    </div>

    <div>
        <label for="serietec" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Serie
            Tec</label>
        <input type="text" id="serietec" wire:model="serietec" name="serietec"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
        <x-input-error :messages="$errors->get('serietec')" class="mt-2" />
    </div>

    <div>
        <label for="estado" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Estado</label>
        <select id="estado" wire:model="estado" name="estado"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            <option value="">Selecciona un opcion</option>
            @foreach (config('constants.estados') as $key => $value)
                <option value="{{ $key }}" @selected($estado == $key)>{{ $value }}</option>
            @endforeach
        </select>
        <x-input-error :messages="$errors->get('estado')" class="mt-2" />
    </div>
    <div>
        <label for="area" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Area</label>
        <input type="text" id="area" wire:model="area" name="area"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
        <x-input-error :messages="$errors->get('area')" class="mt-2" />
    </div>
    <div>
        <label for="ubicacion" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ubicacion</label>
        <input type="text" id="ubicacion" wire:model="ubicacion" name="ubicacion"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
        <x-input-error :messages="$errors->get('ubicacion')" class="mt-2" />
    </div>
    <div>
        <label for="marca_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Selecciona un
            marca</label>
        <select id="marca_id" wire:model="marca_id" name="marca_id"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            <option value="">Escoge una marca</option>
            @foreach ($marcas as $marca)
                <option value="{{ $marca->id }}" @selected($marca_id == $marca->id)>{{ $marca->nombre }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label for="encargado_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">A cargo
            de:</label>
        <select id="encargado_id" wire:model="encargado_id" name="encargado_id"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            <option value="">Selecciona</option>
            @foreach ($encargados as $encargado)
                <option value="{{ $encargado->id }}" @selected($encargado_id == $encargado->id)>{{ $encargado->nombre }}
                </option>
            @endforeach
        </select>
    </div>
</div>
