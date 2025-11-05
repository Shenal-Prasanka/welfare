<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            PermissionSeeder::class,
            UserSeeder::class,
            AssignRolesToUsersSeeder::class,
            RankSeeder::class,
            RegementSeeder::class,
            UnitSeeder::class,
            LoanInterestSeeder::class,
        ]);
    }
}
