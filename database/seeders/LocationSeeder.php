<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $locations = [
            [
                'designation' => 'Forest National',
                'address' => 'Avenue Victor Rousseau 208, 1190 Forest, Brussels',
                'locality_id' => 1,
                'capacity' => '8000',
                'image' => 'https://th.bing.com/th/id/R.f7188c0ca9028d4823921a8ae4b58c1e?rik=AoqjVh1Vi6d1QQ&pid=ImgRaw&r=0',
                'website' => 'https://www.forest-national.be/',
                'phone' => '+32 2 345 89 99',
            ],
            [
                'designation' => 'Ancienne Belgique',
                'address' => 'Boulevard Anspach 110, 1000 Brussels',
                'locality_id' => 2,
                'capacity' => '2000',
                'image' => 'https://th.bing.com/th/id/R.a7537c187005d93414e4db8b3e392d96?rik=OQeOZw%2fhrZLcKA&pid=ImgRaw&r=0',
                'website' => 'https://www.abconcerts.be/',
                'phone' => '+32 2 548 24 84',
            ],
            [
                'designation' => 'Vorst Nationaal',
                'address' => 'Avenue Victor Rousseau 208, 1190 Forest',
                'locality_id' => 3,
                'capacity' => '8500',
                'image' => 'https://th.bing.com/th/id/R.20844252d727a796d55000533f26393e?rik=xC%2fYNvo1QIyN9g&pid=ImgRaw&r=0',
                'website' => null,
                'phone' => null,
            ],
            [
                'designation' => 'Sportpaleis Antwerpen',
                'address' => 'Schijnpoortweg 119, 2170 Antwerpen',
                'locality_id' => 4,
                'capacity' => '23500',
                'image' => 'https://i.ytimg.com/vi/Ptebu28SD44/maxresdefault.jpg',
                'website' => 'https://www.sportpaleis.be/',
                'phone' => '+32 3 400 40 40',
            ],
            [
                'designation' => 'Botanique',
                'address' => 'Rue Royale 236, 1210 Brussels',
                'locality_id' => 5,
                'capacity' => '700',
                'image' => 'https://th.bing.com/th/id/OIP.s2SfaRC3Qp4M6jCRtvzaegHaEK?o=7rm=3&rs=1&pid=ImgDetMain&o=7&rm=3',
                'website' => 'https://botanique.be/',
                'phone' => '+32 2 226 12 11',
            ],
            [
                'designation' => 'Le Reflektor',
                'address' => 'Place Xavier-Neujean 24, 4000 Liège',
                'locality_id' => 6,
                'capacity' => '800',
                'image' => 'https://th.bing.com/th/id/R.502ed25c0c8200ad0d935f941ed888a3?rik=9jn8CY0qms13YQ&pid=ImgRaw&r=0',
                'website' => 'https://reflektor.be/',
                'phone' => '+32 4 223 11 16',
            ],
            [
                'designation' => 'Le Forum de Liège',
                'address' => 'Rue Pont d’Avroy 14, 4000 Liège',
                'locality_id' => 7,
                'capacity' => '1800',
                'image' => 'https://tse2.mm.bing.net/th/id/OIP.-ac7hZWkmkX3cDsQot-LdgHaDM?rs=1&pid=ImgDetMain&o=7&rm=3',
                'website' => 'https://www.leforum.be/',
                'phone' => '+32 4 223 32 67',
            ],
            [
                'designation' => 'Cirque Royal',
                'address' => 'Rue de l’Enseignement 81, 1000 Brussels',
                'locality_id' => 8,
                'capacity' => '2000',
                'image' => 'https://th.bing.com/th/id/OLC.6l7Qv3qyejL38A480x360?&rs=1&pid=ImgDetMain&o=7&rm=3',
                'website' => 'https://cirque-royal-bruxelles.be/',
                'phone' => '+32 2 218 20 15',
            ],
            [
                'designation' => 'La Madeleine',
                'address' => 'Rue Duquesnoy 14, 1000 Brussels',
                'locality_id' => 9,
                'capacity' => '1000',
                'image' => 'https://th.bing.com/th/id/OIP.bBy2ElY3-MiDhKQilIiQ_AHaFj?o=7rm=3&rs=1&pid=ImgDetMain&o=7&rm=3',
                'website' => 'https://www.lamadeleine.be/',
                'phone' => null,
            ],
            [
                'designation' => 'Trix Antwerp',
                'address' => 'Noordersingel 28-30, 2140 Antwerp',
                'locality_id' => 10,
                'capacity' => '1100',
                'image' => 'https://th.bing.com/th/id/OIP.go8mLYMa7_XVXTrgWQEr3gHaE7?o=7rm=3&rs=1&pid=ImgDetMain&o=7&rm=3',
                'website' => 'https://www.trixonline.be/',
                'phone' => '+32 3 670 09 00',
            ],
        ];

        foreach ($locations as &$location) {
            $location['slug'] = Str::slug($location['designation'], '-');
            
            Location::create($location);
        }

       
    }
}
