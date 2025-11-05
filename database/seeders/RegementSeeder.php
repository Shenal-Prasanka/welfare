<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Regement;

class RegementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $regements = [
            'Commando Regiment',
            'Engineer Services Regiment',
            'Gajaba Regiment',
            'Gemunu Watch',
            'Mechanized Infantry Regiment',
            'Military Intelligence Corps',
            'Special Forces Regiment',
            'Sri Lanka Armoured Corps',
            'Sri Lanka Army Corps of Agriculture and Livestock',
            'Sri Lanka Army General Service Corps',
            'Sri Lanka Army Medical Corps',
            'Sri Lanka Army Ordnance Corps',
            'Sri Lanka Army Pioneer Corps',
            'Sri Lanka Army Service Corps',
            'Sri Lanka Army Womens Corps',
            'Sri Lanka Artillery',
            'Sri Lanka Corps of Military Police',
            'Sri Lanka Electrical and Mechanical Engineers',
            'Sri Lanka Engineers',
            'Sri Lanka Light Infantry',
            'Sri Lanka National Guard',
            'Sri Lanka Rifle Corps',
            'Sri Lanka Signals Corps',
            'Sri Lanka Sinha Regiment',
            'Vijayabahu Infantry Regiment',
        ];

        foreach ($regements as $regementName) {
            Regement::create([
                'regement' => $regementName,
                'is_deleted' => 0,
            ]);
        }
    }
}
