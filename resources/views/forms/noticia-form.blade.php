<x-modals :name="'Formulario Noticia'" width="xl">
    <form wire:submit="store" class="p-4 md:p-5">
        <div class="grid gap-4 mb-4">
            <div>
                <label for="titulo" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Titulo</label>
                <input type="text" name="titulo" wire:model="titulo" id="titulo"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    required />
                <x-input-error :messages="$errors->get('titulo')" class="mt-2" />
            </div>
            <div>
                <label for="body" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Body</label>
                <textarea id="body" wire:model="body" name="body" rows="4"
                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Write your thoughts here..."></textarea>
                <x-input-error :messages="$errors->get('body')" class="mt-2" />
            </div>
            <div class="relative w-full">
                <label for="image"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Imagen</label>
                <input type="file" name="image" wire:model="image" id="image"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="image" required>
                <div class="text-red-600">
                    @error('image')
                        {{ $message }}
                    @enderror
                </div>
                <div class="mt-2">
                    <div wire:loading wire:target="image">
                        Cargando...
                    </div>
                    @if ($image)
                        <div class="w-full flex justify-center">
                            <img src="{{ $image->temporaryUrl() }}" class="w-48 h-36 object-cover">
                        </div>
                    @elseif($noticia_id)
                        <div class="w-full flex justify-center">
                            <img src="{{ Storage::url($oldImage) }}" class="w-48 h-36 object-cover">
                        </div>
                    @endif
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="categoria_id"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Selecciona una
                        categoria</label>
                    <select id="categoria_id" wire:model="categoria_id" name="categoria_id"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="">Escoge una categoria</option>
                        @foreach ($categorias as $categoria)
                            <option value="{{ $categoria->id }}" @selected($categoria_id == $categoria->id)>{{ $categoria->name }}
                            </option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('categoria_id')" class="mt-2" />

                </div>

                <div class="flex items-center mt-2">
                    <input id="checked-checkbox" name="enabled" wire:model="status" type="checkbox"
                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="checked-checkbox"
                        class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Publicado</label>
                </div>


            </div>

        </div>
        <button type="submit"
            class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            {{ $noticia_id ? 'Actualizar' : 'Guardar' }}
        </button>
    </form>
</x-modals>
