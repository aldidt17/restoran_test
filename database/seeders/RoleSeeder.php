<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'kasir']);

        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('12345')
        ]);
        $admin->assignRole('admin');

        $kasir = User::create([
            'name' => 'Kasir',
            'email' => 'kasir@example.com',
            'password' => bcrypt('123')
        ]);
        $kasir->assignRole('kasir');
}
}