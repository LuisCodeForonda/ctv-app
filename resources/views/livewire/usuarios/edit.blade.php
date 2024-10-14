<?php

use Livewire\Volt\Component;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use App\Models\User;
use Spatie\Permission\Models\Role;

new #[Layout('layouts.app')] class extends Component {
    
    public User $usuario;

    //variables del modelo
    public $name;
    public $email;
    public $enabled;
    public $rol;

    public function mount(User $usuario)
    {
        $this->fill($usuario);
        $this->name = $usuario->name;
        $this->email = $usuario->email;
        $this->enabled = $usuario->enabled ? true : false;
        $this->rol = $usuario->getRoleNames()->first();
    }

    public function save()
    {
        $this->usuario->update([
            'enable' => $this->enabled,
        ]);

        //actulizando el rol
        $this->usuario->syncRoles($this->rol);

        return $this->redirect('/usuarios', navigate: true);
    }

    public function with()
    {
        return [
            'roles' => Role::all(),
        ];
    }

}; ?>

<div>
    @slot('header')
        <h1 class="font-bold">Usuarios > edit</h1>
    @endslot
    <x-layout-form title="Editar usuario">
        @include('forms.user-form')

        <div class="flex justify-end gap-2">

            <x-secondary-button href="{{ route('usuarios.index') }}" wire:navigate>Cancelar</x-secondary-button>
            <x-primary-button>Actualizar</x-primary-button>
        </div>
    </x-layout-form>
</div>
