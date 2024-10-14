<?php

namespace Database\Seeders;

use App\Models\PackageServices;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PackageServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PackageServices::firstOrCreate([
            'package_id' => '1',
            'service_id' => '1',
        ]);

        PackageServices::firstOrCreate([
            'package_id' => '1',
            'service_id' => '2',
        ]);

    }
}
