@props(['width' => 'md'])

<form wire:submit="save" {{ $attributes->merge(['class' => 'max-w-'.$width.' mx-auto p-4 border-1 border-gray-200 shadow-md rounded-md bg-white dark:bg-gray-800' ]) }}>
    {{ $slot }}
</form>
