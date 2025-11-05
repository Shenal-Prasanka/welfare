<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Rank;

class RankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ranks = [
            ['rank' => 'Field Marshal', 'type' => 'Officer'],
            ['rank' => 'General', 'type' => 'Officer'],
            ['rank' => 'Lieutenant General', 'type' => 'Officer'],
            ['rank' => 'Major General', 'type' => 'Officer'],
            ['rank' => 'Brigadier', 'type' => 'Officer'],
            ['rank' => 'Colonel', 'type' => 'Officer'],
            ['rank' => 'Lieutenant Colonel', 'type' => 'Officer'],
            ['rank' => 'Major', 'type' => 'Officer'],
            ['rank' => 'Captain', 'type' => 'Officer'],
            ['rank' => 'Lieutenant', 'type' => 'Officer'],
            ['rank' => '2nd Lieutenant', 'type' => 'Officer'],
            ['rank' => 'Warrant Officer Class I', 'type' => 'Other'],
            ['rank' => 'Warrant Officer Class II', 'type' => 'Other'],
            ['rank' => 'Staff Sergeant', 'type' => 'Other'],
            ['rank' => 'Sergeant', 'type' => 'Other'],
            ['rank' => 'Corporal', 'type' => 'Other'],
            ['rank' => 'Lance Corporal', 'type' => 'Other'],
            ['rank' => 'Private', 'type' => 'Other'],
        ];

        foreach ($ranks as $rankData) {
            Rank::create([
                'rank' => $rankData['rank'],
                'type' => $rankData['type'],
                'is_deleted' => 0,
            ]);
        }
    }
}
