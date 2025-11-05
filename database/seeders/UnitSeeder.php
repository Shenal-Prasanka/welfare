<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Unit;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $units = [
            ['unit' => 'CR1', 'regement_id' => 1],
            ['unit' => 'CR2', 'regement_id' => 1],
            ['unit' => 'ESR1', 'regement_id' => 2],
            ['unit' => 'ESR2', 'regement_id' => 2],
            ['unit' => 'GR1', 'regement_id' => 3],
            ['unit' => 'GR2', 'regement_id' => 3],
        ];

        foreach ($units as $unitData) {
            Unit::create([
                'unit' => $unitData['unit'],
                'regement_id' => $unitData['regement_id'],
                'active' => 1,
                'is_deleted' => 0,
            ]);
        }
    }
}
