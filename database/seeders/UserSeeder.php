<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
         User::create([
            'name' => 'Bimal',
            'email' => 'bimal@gmail.com',
            'mobile' => '0712518900',
            'address' => 'PahalaYagoda,Ganemulla',
            'employee_no' => 'E500',
            'regement_no' => 'R500',
            'regement_id' => '3',
            'unit_id' => '3',
            'rank_id' => '3',
            'is_deleted' => '1',
            'password' => Hash::make('123456789'),
    ]);
    }
}
