<?php

namespace Database\Seeders;

use App\Models\Price;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PriceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $prices = [
            [
                'type' => 'Standard',
                'price' => '25.00',
                'start_date' => Carbon::now(),
                'end_date' => Carbon::now()->addMonths(3),
            ],
            [
                'type' => 'Student',
                'price' => '15.00',
                'start_date' => Carbon::now(),
                'end_date' => Carbon::now()->addMonths(3),
            ],
            [
                'type' => 'Senior',
                'price' => '18.00',
                'start_date' => Carbon::now(),
                'end_date' => Carbon::now()->addMonths(3),
            ],
            [
                'type' => 'Early Bird',
                'price' => '20.00',
                'start_date' => Carbon::now()->subDays(10),
                'end_date' => Carbon::now()->addDays(10),
            ],
            [
                'type' => 'VIP',
                'price' => '50.00',
                'start_date' => Carbon::now(),
                'end_date' => Carbon::now()->addMonths(3),
            ],
        ];

        foreach ($prices as $price) {
            Price::create($price);
        }
    }
}
