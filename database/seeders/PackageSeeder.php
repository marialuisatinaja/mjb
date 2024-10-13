<?php

namespace Database\Seeders;

use App\Models\Package;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Package::firstOrCreate([
            'name' => 'Sauna + Ventosa',
            'amount' => '₱ 1,099',
            'persons'=> '1',
            'hours'=> '1',
            'description' => 'Release tension and detoxify with a revitalizing Ventosa massage—experience the healing power of suction therapy for deep relaxation and balance',
        ]);
    }
}
