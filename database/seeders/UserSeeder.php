<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
        ]);

        // Attach admin role to the admin user
        $adminRole = Role::where('name', 'admin')->first();
        $admin->roles()->attach($adminRole);

        // Create users for other departments
        $registrar = User::create([
            'name' => 'Registrar User',
            'email' => 'registrar@example.com',
            'password' => Hash::make('password'),
        ]);

        $registrarRole = Role::where('name', 'registrar')->first();
        $registrar->roles()->attach($registrarRole);

        $cashier = User::create([
            'name' => 'Cashier User',
            'email' => 'cashier@example.com',
            'password' => Hash::make('password'),
        ]);

        $cashierRole = Role::where('name', 'cashier')->first();
        $cashier->roles()->attach($cashierRole);

        $finance = User::create([
            'name' => 'Finance User',
            'email' => 'finance@example.com',
            'password' => Hash::make('password'),
        ]);

        $financeRole = Role::where('name', 'finance')->first();
        $finance->roles()->attach($financeRole);
    }
}
