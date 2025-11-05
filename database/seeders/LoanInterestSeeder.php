<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\LoanInterest;

class LoanInterestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $loanInterests = [
            ['months' => '4', 'interest' => 2.50],
            ['months' => '8', 'interest' => 3.00],
            ['months' => '12', 'interest' => 3.50],
            ['months' => '24', 'interest' => 4.00],
            ['months' => '36', 'interest' => 4.50],
        ];

        foreach ($loanInterests as $loanInterest) {
            LoanInterest::create($loanInterest);
        }
    }
}
