<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $role = Role::create(['name' => 'admin']);

        Permission::create(['name' => 'dahsboard.index', 'category' => 'dashboard'])->syncRoles([$role]);

        Permission::create(['name' => 'user index', 'category' => 'Usuarios'])->syncRoles([$role]);
        Permission::create(['name' => 'user create', 'category' => 'Usuarios'])->syncRoles([$role]);
        Permission::create(['name' => 'user edit', 'category' => 'Usuarios'])->syncRoles([$role]);
        Permission::create(['name' => 'user pdf', 'category' => 'Usuarios'])->syncRoles([$role]);

        Permission::create(['name' => 'rol index', 'category' => 'Rol'])->syncRoles([$role]);
        Permission::create(['name' => 'rol create', 'category' => 'Rol'])->syncRoles([$role]);
        Permission::create(['name' => 'rol edit', 'category' => 'Rol'])->syncRoles([$role]);
        Permission::create(['name' => 'rol delete', 'category' => 'Rol'])->syncRoles([$role]);

        Permission::create(['name' => 'marca index', 'category' => 'Marca'])->syncRoles([$role]);
        Permission::create(['name' => 'marca create', 'category' => 'Marca'])->syncRoles([$role]);
        Permission::create(['name' => 'marca edit', 'category' => 'Marca'])->syncRoles([$role]);
        Permission::create(['name' => 'marca destroy', 'category' => 'Marca'])->syncRoles([$role]);
        Permission::create(['name' => 'marca pdf', 'category' => 'Marca'])->syncRoles([$role]);

        Permission::create(['name' => 'equipo index', 'category' => 'Equipo'])->syncRoles([$role]);
        Permission::create(['name' => 'equipo create', 'category' => 'Equipo'])->syncRoles([$role]);
        Permission::create(['name' => 'equipo edit', 'category' => 'Equipo'])->syncRoles([$role]);
        Permission::create(['name' => 'equipo destroy', 'category' => 'Equipo'])->syncRoles([$role]);
        Permission::create(['name' => 'equipo show', 'category' => 'Equipo'])->syncRoles([$role]);
        Permission::create(['name' => 'equipo pdf', 'category' => 'Equipo'])->syncRoles([$role]);

        Permission::create(['name' => 'accesorio index', 'category' => 'Accesorio'])->syncRoles([$role]);
        Permission::create(['name' => 'accesorio create', 'category' => 'Accesorio'])->syncRoles([$role]);
        Permission::create(['name' => 'accesorio edit', 'category' => 'Accesorio'])->syncRoles([$role]);
        Permission::create(['name' => 'accesorio destroy', 'category' => 'Accesorio'])->syncRoles([$role]);

        Permission::create(['name' => 'accion index', 'category' => 'Accion'])->syncRoles([$role]);
        Permission::create(['name' => 'accion create', 'category' => 'Accion'])->syncRoles([$role]);
        Permission::create(['name' => 'accion edit', 'category' => 'Accion'])->syncRoles([$role]);
        Permission::create(['name' => 'accion destroy', 'category' => 'Accion'])->syncRoles([$role]);

        Permission::create(['name' => 'persona index', 'category' => 'Persona'])->syncRoles([$role]);
        Permission::create(['name' => 'persona create', 'category' => 'Persona'])->syncRoles([$role]);
        Permission::create(['name' => 'persona edit', 'category' => 'Persona'])->syncRoles([$role]);
        Permission::create(['name' => 'persona destroy', 'category' => 'Persona'])->syncRoles([$role]);
        Permission::create(['name' => 'persona pdf', 'category' => 'Persona'])->syncRoles([$role]);
        

        \App\Models\User::create([
            'name' => 'jose Foronda',
            'email' => 'jose@gmail.com',
            'password' => Hash::make('12345678'),
            'enabled' => true,
        ])->assignRole('admin');
    }
}
