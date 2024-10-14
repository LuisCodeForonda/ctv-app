@props(['title' => "Formulario"])
<form wire:submit="save" {{ $attributes->merge(['class' => 'mx-auto p-4 border-1 border-gray-200 shadow-md rounded-md bg-white dark:bg-gray-800' ]) }}>
    <h2 class="mb-2 font-bold">{{ $title }}</h2>
    {{ $slot }}
</form>
