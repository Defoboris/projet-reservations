<?php

namespace Database\Seeders;

use App\Models\Locality;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LocalitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $localities = [
            ['postal_code' => '1000', 'name' => 'Bruxelles'],
            ['postal_code' => '1030', 'name' => 'Schaerbeek'],
            ['postal_code' => '1040', 'name' => 'Etterbeek'],
            ['postal_code' => '1050', 'name' => 'Ixelles'],
            ['postal_code' => '1060', 'name' => 'Saint-Gilles'],
            ['postal_code' => '1070', 'name' => 'Anderlecht'],
            ['postal_code' => '1080', 'name' => 'Molenbeek-Saint-Jean'],
            ['postal_code' => '1081', 'name' => 'Koekelberg'],
            ['postal_code' => '1082', 'name' => 'Berchem-Sainte-Agathe'],
            ['postal_code' => '1083', 'name' => 'Ganshoren'],
            ['postal_code' => '1090', 'name' => 'Jette'],
            ['postal_code' => '1200', 'name' => 'Woluwe-Saint-Lambert'],
            ['postal_code' => '1210', 'name' => 'Saint-Josse-ten-Noode'],
            ['postal_code' => '1300', 'name' => 'Wavre'],
            ['postal_code' => '1400', 'name' => 'Nivelles'],
            ['postal_code' => '4000', 'name' => 'Liège'],
            ['postal_code' => '5000', 'name' => 'Namur'],
            ['postal_code' => '6000', 'name' => 'Charleroi'],
            ['postal_code' => '8000', 'name' => 'Bruges'],
            ['postal_code' => '9000', 'name' => 'Gand'],
        ];

        foreach ($localities as $data) {
            Locality::create($data);
        }
    }
}
