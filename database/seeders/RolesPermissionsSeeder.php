<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class RolesPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = ['view', 'create', 'edit', 'delete', 'restore', 'forceDestroy'];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        $adminRole = Role::create(['name' => 'Admin']);
        $adminRole->permissions()->attach(Permission::all());

        $writerRole = Role::create(['name' => 'Writer']);
        $writerRole->permissions()->attach(Permission::whereIn('name',['view', 'create', 'edit', 'delete'])->get());

        $readerRole = Role::create(['name' => 'Reader']);
        $readerRole->permissions()->attach(Permission::whereIn('name',['view',])->get());

        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
        ]);
        $admin->roles()->attach($adminRole);

        $writer = User::create([
            'name' => 'Writer',
            'email' => 'writer@example.com',
            'password' => bcrypt('password'),
        ]);
        $writer->roles()->attach($writerRole);

        $reader = User::create([
            'name' => 'Reader',
            'email' => 'reader@example.com',
            'password' => bcrypt('password'),
        ]);
        $reader->roles()->attach($readerRole);
    }
}
