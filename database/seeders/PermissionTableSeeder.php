<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Permissions
        $permissions = [
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'hero-list',
            'hero-create',
            'hero-edit',
            'hero-delete',
            'atribut-list',
            'atribut-create',
            'atribut-edit',
            'atribut-delete',
            'posisi-list',
            'posisi-create',
            'posisi-edit',
            'posisi-delete'

        ];
       
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}