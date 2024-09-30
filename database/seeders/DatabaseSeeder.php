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

        Permission::create(['name' => 'user index', 'category' => 'Usuarios'])->syncRoles([$role]);
        Permission::create(['name' => 'user create', 'category' => 'Usuarios'])->syncRoles([$role]);
        Permission::create(['name' => 'user edit', 'category' => 'Usuarios'])->syncRoles([$role]);
        Permission::create(['name' => 'user destroy', 'category' => 'Usuarios'])->syncRoles([$role]);

        Permission::create(['name' => 'rol index', 'category' => 'Rol'])->syncRoles([$role]);
        Permission::create(['name' => 'rol create', 'category' => 'Rol'])->syncRoles([$role]);
        Permission::create(['name' => 'rol edit', 'category' => 'Rol'])->syncRoles([$role]);
        Permission::create(['name' => 'rol destroy', 'category' => 'Rol'])->syncRoles([$role]);

        Permission::create(['name' => 'marca index', 'category' => 'Marca'])->syncRoles([$role]);
        Permission::create(['name' => 'marca create', 'category' => 'Marca'])->syncRoles([$role]);
        Permission::create(['name' => 'marca edit', 'category' => 'Marca'])->syncRoles([$role]);
        Permission::create(['name' => 'marca destroy', 'category' => 'Marca'])->syncRoles([$role]);
        Permission::create(['name' => 'marca export', 'category' => 'Marca'])->syncRoles([$role]);

        Permission::create(['name' => 'responsable index', 'category' => 'Responsable'])->syncRoles([$role]);
        Permission::create(['name' => 'responsable create', 'category' => 'Responsable'])->syncRoles([$role]);
        Permission::create(['name' => 'responsable edit', 'category' => 'Responsable'])->syncRoles([$role]);
        Permission::create(['name' => 'responsable destroy', 'category' => 'Responsable'])->syncRoles([$role]);
        Permission::create(['name' => 'responsable export', 'category' => 'Responsable'])->syncRoles([$role]);

        Permission::create(['name' => 'componente index', 'category' => 'Componente'])->syncRoles([$role]);
        Permission::create(['name' => 'componente create', 'category' => 'Componente'])->syncRoles([$role]);
        Permission::create(['name' => 'componente edit', 'category' => 'Componente'])->syncRoles([$role]);
        Permission::create(['name' => 'componente destroy', 'category' => 'Componente'])->syncRoles([$role]);
        Permission::create(['name' => 'componente export', 'category' => 'Componente'])->syncRoles([$role]);

        Permission::create(['name' => 'equipo index', 'category' => 'Equipo'])->syncRoles([$role]);
        Permission::create(['name' => 'equipo create', 'category' => 'Equipo'])->syncRoles([$role]);
        Permission::create(['name' => 'equipo show', 'category' => 'Equipo'])->syncRoles([$role]);
        Permission::create(['name' => 'equipo edit', 'category' => 'Equipo'])->syncRoles([$role]);
        Permission::create(['name' => 'equipo destroy', 'category' => 'Equipo'])->syncRoles([$role]);
        Permission::create(['name' => 'equipo export', 'category' => 'Equipo'])->syncRoles([$role]);
        
        Permission::create(['name' => 'categoria index', 'category' => 'Categoria'])->syncRoles([$role]);
        Permission::create(['name' => 'categoria create', 'category' => 'Categoria'])->syncRoles([$role]);
        Permission::create(['name' => 'categoria edit', 'category' => 'Categoria'])->syncRoles([$role]);
        Permission::create(['name' => 'categoria destroy', 'category' => 'Categoria'])->syncRoles([$role]);

        Permission::create(['name' => 'noticia index', 'category' => 'Noticia'])->syncRoles([$role]);
        Permission::create(['name' => 'noticia create', 'category' => 'Noticia'])->syncRoles([$role]);
        Permission::create(['name' => 'noticia edit', 'category' => 'Noticia'])->syncRoles([$role]);
        Permission::create(['name' => 'noticia destroy', 'category' => 'Noticia'])->syncRoles([$role]);


    

        \App\Models\User::create([
            'name' => 'Miguel Martinez',
            'email' => 'miguel@gmail.com',
            'password' => Hash::make('codeX439G'),
            'enabled' => true,
        ])->assignRole('admin');

        \App\Models\User::create([
            'name' => 'luis Foronda',
            'email' => 'luis@gmail.com',
            'password' => Hash::make('12345678'),
            'enabled' => true,
        ])->assignRole('admin');

        //Marca::factory(100)->create();
        //Responsable::factory(100)->create();
        //Componente::factory(40)->create();
        //Equipo::factory(500)->create();
    }
}
