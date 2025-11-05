<?php

namespace Database\Seeders;

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
        $roles = [
            'Unit Clerk',
            'Unit OC',
            'Loan Clerk',
            'Loan OC',
            'Ledger Clerk',
            'Ledger OC',
            'Audit Clerk',
            'Audit OC',
            'Account Clerk',
            'Account OC',
            'Account SO',
            'Staff Officer',
            'Colonel Welfare',
            'Director Welfare',
            'User',
        ];

        foreach ($roles as $roleName) {
            Role::firstOrCreate(['name' => $roleName]);
        }
    }
}
