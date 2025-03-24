<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Sauce;

class SauceSeeder extends Seeder
{
    public function run()
    {
        Sauce::create([
            'user_id' => 1,
            'name' => 'Hellfire Fear This',
            'manufacturer' => 'Hellfire Hot Sauce',
            'description' => 'Une sauce ultra-piquante à base de piments Carolina Reaper.',
            'mainPepper' => 'Carolina Reaper',
            'imageUrl' => 'https://www.sauce-piquante.fr/3293-large_default/hellfire-fear-this-sauce.jpg',
            'heat' => 9,
            'likes' => 0,
            'dislikes' => 0,
            'usersLiked' => [],
            'usersDisliked' => [],
        ]);

        Sauce::create([
            'user_id' => 2,
            'name' => 'Hellfire Elixir',
            'manufacturer' => 'Hellfire Hot Sauce',
            'description' => 'Une sauce fruitée et piquante avec piments habanero et fruits.',
            'mainPepper' => 'Habanero',
            'imageUrl' => 'https://www.sauce-piquante.fr/1693-large_default/hellfire-elixir-sauce.jpg',
            'heat' => 7,
            'likes' => 0,
            'dislikes' => 0,
            'usersLiked' => [],
            'usersDisliked' => [],
        ]);
        
        Sauce::create([
            'user_id' => 3,
            'name' => 'Jalapeno Fumé',
            'manufacturer' => 'Sauce Piquante',
            'description' => 'Une sauce fumée à base de jalapeños grillés.',
            'mainPepper' => 'Jalapeno',
            'imageUrl' => 'https://www.sauce-piquante.fr/2360-large_default/seed-ranch-jalapeno-fume.jpg',
            'heat' => 6,
            'likes' => 0,
            'dislikes' => 0,
            'usersLiked' => [],
            'usersDisliked' => [],
        ]);
        
        Sauce::create([
            'user_id' => 1,
            'name' => 'Sauce Ail Noir Jolokia',
            'manufacturer' => 'Sauce Piquante',
            'description' => 'Une sauce mariant l\'ail noir et le piment Bhut Jolokia.',
            'mainPepper' => 'Bhut Jolokia',
            'imageUrl' => 'https://www.sauce-piquante.fr/826-large_default/sauce-jolokia-ail-noir-cajohns.jpg',
            'heat' => 8,
            'likes' => 0,
            'dislikes' => 0,
            'usersLiked' => [],
            'usersDisliked' => [],
        ]);
        
        Sauce::create([
            'user_id' => 2,
            'name' => 'Carolina Reaper',
            'manufacturer' => 'Piments Extremes',
            'description' => 'Une sauce extrême avec le piment le plus fort du monde.',
            'mainPepper' => 'Carolina Reaper',
            'imageUrl' => 'https://www.sauce-piquante.fr/2508-large_default/plant-carolina-reaper-jaune.jpg',
            'heat' => 10,
            'likes' => 0,
            'dislikes' => 0,
            'usersLiked' => [],
            'usersDisliked' => [],
        ]);
    }
}
