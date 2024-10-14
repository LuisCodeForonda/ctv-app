<?php

use Livewire\Volt\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Livewire\Attributes\Layout;

new #[Layout('layouts.app')] class extends Component {
    //variables del modelo
    public $name;
    public $selectedPermissions = [];

    public function save()
    {
        $this->validate([
            'name' => ['required', 'string', 'min:3', 'unique:roles,name'],
        ]);

        $rol = Role::create(['name' => $this->name]);
        $rol->syncPermissions($this->selectedPermissions);

        return $this->redirect('/roles', navigate: true);
    }

    public function with()
    {
        return [
            'roles' => Role::all(),
            'permisos' => Permission::all()->groupBy('category')->toArray(),
        ];
    }
}; ?>

<div>
    @slot('header')
        <h1 class="font-bold">Roles > create</h1>
    @endslot

    <x-layout-form title="Crear rol">
        @include('forms.rol-form')
        <div class="flex justify-end gap-2">
            <x-secondary-button href="{{ route('roles.index') }}" wire:navigate>Cancelar</x-secondary-button>
            <x-primary-button>Guardar</x-primary-button>
        </div>
    </x-layout-form>
</div>
