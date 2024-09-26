<?php

use Livewire\Volt\Component;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Livewire\Attributes\Layout;

new #[Layout('layouts.app')] class extends Component {
    public Role $role;

    public $name;
    public $selectedPermissions = [];

    public function mount(Role $role)
    {
        $this->fill($role);
        $this->name = $role->name;
        $this->selectedPermissions = $role->permissions()->pluck('name')->toArray(); //obtenemos todos los permisos del rol seleccionado //obtenemos los registro agrupados por la categoria y lo combertimos en un array
    }

    public function save()
    {
        $this->validate([
            'name' => ['required', 'string', 'min:3'],
        ]);

        $this->role->update([
            'name' => $this->name,
        ]);

        //actulizando el rol
        $this->role->syncPermissions($this->selectedPermissions);

        return $this->redirect('/roles', navigate: true);
    }

    public function with()
    {
        return [
            'permisos' => Permission::all()->groupBy('category')->toArray(),
        ];
    }
}; ?>

<div>
    @slot('header')
        <h1 class="font-bold">Roles > edit</h1>
    @endslot

    <h1 class="text-center">Formulario</h1>
    <x-layout-form width="xl">
        @include('forms.rol-form')

        <div class="flex justify-end gap-2">

            <x-secondary-button href="{{ route('roles.index') }}" wire:navigate>Cancelar</x-secondary-button>
            <x-primary-button>Actualizar</x-primary-button>
        </div>
    </x-layout-form>
</div>
