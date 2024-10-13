<?php

namespace Database\Seeders;

use App\Models\Services;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Services::firstOrCreate([
            'title' => 'Sauna',
            'type' => 'Other Services',
            'amount' => '649',
            'hours' => '1',
            'minutes' => '',
            'description' => 'Detoxify and unwind in our soothing sauna—embrace the warmth, relax your muscles, and let the stress melt away',
        ]);

        Services::firstOrCreate([
            'title' => 'Painit sa Likod',
            'type' => 'Ventosa',
            'amount' => '549',
            'hours' => '1',
            'minutes' => '',
            'description' => 'Release tension and detoxify with a revitalizing Ventosa massage—experience the healing power of suction therapy for deep relaxation and balance',
        ]);

        Services::firstOrCreate([
            'title' => 'Bol-anong Amuma',
            'type' => 'Signature Masaje',
            'amount' => '449',
            'hours' => '1',
            'minutes' => '',
            'description' => 'Indulge in our exclusive Signature Massage—crafted to melt away stress and tailor-fit to your unique relaxation needs',
        ]);

        Services::firstOrCreate([
            'title' => 'Himas Masaje',
            'type' => 'Swedish Massage',
            'amount' => '449',
            'hours' => '1',
            'minutes' => '',
            'description' => 'Experience ultimate relaxation with a soothing Swedish massage—rejuvenate your body, mind, and soul with gentle, flowing strokes',
        ]);

    }
}
