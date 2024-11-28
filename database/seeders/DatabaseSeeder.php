<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Componente;
use App\Models\Equipo;
use App\Models\Marca;
use App\Models\Responsable;
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
        $role2 = Role::create(['name' => 'editor']);

        Permission::create(['name' => 'dahsboard.index', 'category' => 'dashboard'])->syncRoles([$role]);

        Permission::create(['name' => 'user', 'category' => 'Administracion'])->syncRoles([$role]);
        Permission::create(['name' => 'rol', 'category' => 'Administracion'])->syncRoles([$role]);

        Permission::create(['name' => 'marca', 'category' => 'Equipos'])->syncRoles([$role]);
        Permission::create(['name' => 'responsable', 'category' => 'Equipos'])->syncRoles([$role]);
        Permission::create(['name' => 'componente', 'category' => 'Equipos'])->syncRoles([$role]);
        Permission::create(['name' => 'equipo', 'category' => 'Equipos'])->syncRoles([$role]);
        Permission::create(['name' => 'categoria', 'category' => 'Equipos'])->syncRoles([$role]);

        Permission::create(['name' => 'noticia index', 'category' => 'Noticia'])->syncRoles([$role]);
        Permission::create(['name' => 'noticia create', 'category' => 'Noticia'])->syncRoles([$role]);
        Permission::create(['name' => 'noticia edit', 'category' => 'Noticia'])->syncRoles([$role]);
        Permission::create(['name' => 'noticia destroy', 'category' => 'Noticia'])->syncRoles([$role]);


    

        // \App\Models\User::create([
        //     'name' => 'Miguel Martinez',
        //     'email' => 'miguel@gmail.com',
        //     'password' => Hash::make('codeX439G'),
        //     'enabled' => true,
        // ])->assignRole('admin');

        \App\Models\User::create([
            'name' => 'luis Foronda',
            'email' => 'luis@gmail.com',
            'password' => Hash::make('12345678'),
            'enabled' => true,
        ])->assignRole('admin');

        \App\Models\User::create([
            'name' => 'jose',
            'email' => 'jose@gmail.com',
            'password' => Hash::make('12345678'),
            'enabled' => true,
        ])->assignRole('editor');

        //Marca::factory(100)->create();
        //Responsable::factory(100)->create();
        //Componente::factory(40)->create();
        //Equipo::factory(500)->create();
    }
}
