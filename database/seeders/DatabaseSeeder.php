<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Categoria;
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
        Permission::create(['name' => 'asignacion', 'category' => 'Equipos'])->syncRoles([$role]);
        Permission::create(['name' => 'reporte', 'category' => 'Equipos'])->syncRoles([$role]);

        Permission::create(['name' => 'equipamiento', 'category' => 'Usuario'])->syncRoles([$role]);
        Permission::create(['name' => 'solititud', 'category' => 'Usuario'])->syncRoles([$role]);
        
        // \App\Models\User::create([
        //     'name' => 'Miguel Martinez',
        //     'email' => 'miguel@gmail.com',
        //     'password' => Hash::make('codeX439G'),
        //     'enabled' => true,
        // ])->assignRole('admin');

        $user = \App\Models\User::create([
            'name' => 'luis Foronda',
            'email' => 'luis@gmail.com',
            'password' => Hash::make('12345678'),
            'enabled' => true,
        ])->assignRole('admin');

        $user->perfil()->create([
            'nombre' => 'Luis Alberto Foronda OCndoi',
            'direccion' => 'Av. Buenos aires',
            'cargo' => 'estudiante',
            'carnet' => '13759665',
            'celular' => '39973234',
        ]);
        $user = \App\Models\User::create([
            'name' => 'jose',
            'email' => 'jose@gmail.com',
            'password' => Hash::make('12345678'),
            'enabled' => true,
        ])->assignRole('editor');

        $user->perfil()->create([
            'nombre' => 'Jose Gabriel FOronda',
            'direccion' => 'Av. Buenos aires',
            'cargo' => 'estudiante',
            'carnet' => '882233',
            'celular' => '747232233',
        ]);

        Marca::factory(100)->create();
        Categoria::factory(100)->create();
        Componente::factory(40)->create();
        Equipo::factory(10)->create();
    }
}
