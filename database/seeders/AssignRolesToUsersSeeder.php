<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class AssignRolesToUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userRoles = [
            'shenal@gmail.com' => 'Admin',
            'lahiru@gmail.com' => 'Account SO',
            'aravinda@gmail.com' => 'Unit OC',
            'aruna@gmail.com' => 'Loan Clerk',
            'ashri@gmail.com' => 'Unit Clerk',
            'bimal@gmail.com' => 'Shop Coord Clerk',
            'janith@gmail.com' => 'Membership Clerk',
            'januth@gmail.com' => 'Membership OC',
            'jayee@gmail.com' => 'Shop Coord OC',
            'kamal@gmail.com' => 'Loan OC',
            'isuru@gmail.com' => 'Staff Officer',
            'naveen@gmail.com' => 'Welfare Shop Clerk',
            'nuwan@gmail.com' => 'Welfare Shop Clerk',
            'suneth@gmail.com' => 'Welfare Shop OC',
            'ruwan@gmail.com' => 'Welfare Shop OC',
            'vijay@gmail.com' => 'User',
        ];

        foreach ($userRoles as $email => $roleName) {
            $user = User::where('email', $email)->first();
            if ($user) {
                $user->assignRole($roleName);
                echo "✅ {$roleName} role assigned to {$user->name}\n";
            } else {
                echo "⚠️ User with email {$email} not found\n";
            }
        }
    }
}
