<div class="grid grid-cols-1 gap-4">
    <div>
        <label for="name"
            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre</label>
        <input type="text" name="name" wire:model="name" id="name"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
        @error('name')
            <span class="text-red-600">{{ $message }}</span>
        @enderror
    </div>
    <div>

        <label
            class="block mb-2 text-base font-medium text-gray-900 dark:text-white">Seleccionar
            permisos</label>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
            @foreach ($permisos as $category => $perms)
                {{-- iteramos por cada categoria --}}
                @if (count($perms) > 0)
                    <ul>
                        <h3 class="text-sm font-bold">{{ $category }}</h3>
                        @foreach ($perms as $permission)
                            <li>
                                <input type="checkbox" id="{{ $permission['name'] }}"
                                    wire:model="selectedPermissions" value="{{ $permission['name'] }}"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                                    for="{{ $permission['name'] }}">{{ $permission['name'] }}
                                </label>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p>No permissions in this category.</p>
                @endif
            @endforeach
        </div>
        @error('selectedPermissions')
            <span class="text-red-600">{{ $message }}</span>
        @enderror
    </div>
</div>