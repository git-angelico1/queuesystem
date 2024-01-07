<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Department;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $roles = ['users', 'cash_account', 'reg_account', 'fin_account'];

        foreach ($roles as $role) {
            Role::create(['name' => $role]);
        }

        // Seed departments
        $departments = ['cash_account', 'reg_account', 'fin_account'];

        foreach ($departments as $department) {
            Department::create(['name' => $department]);
        }
    }
}
