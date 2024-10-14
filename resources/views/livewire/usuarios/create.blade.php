<?php

use Livewire\Volt\Component;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use App\Models\User;
use Illuminate\Validation\Rules;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

new #[Layout('layouts.app')] class extends Component {
    //variables del modelo
    public $name;
    public $email;
    public $enabled = false;
    public $password;
    public $password_confirmation;
    public $rol;

    public function save()
    {

        $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'password_confirmation' => ['required_with:password|same:password'],
        ]);

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'enabled' => $this->enabled,
            'rol' => $this->rol,
        ]);

        return $this->redirect('/usuarios', navigate: true);
    }

    public function with(){
        return [
            'roles' => Role::all()
        ];
    }
}; ?>

<div>
    @slot('header')
        <h1 class="font-bold">Usuarios > create</h1>
    @endslot
    <x-layout-form title="Crear usuario">
        @include('forms.user-form')

        <div class="flex justify-end gap-2">
            <x-secondary-button href="{{ route('usuarios.index') }}" wire:navigate>Cancelar</x-secondary-button>
            <x-primary-button>Guardar</x-primary-button>
        </div>
    </x-layout-form>
</div>
