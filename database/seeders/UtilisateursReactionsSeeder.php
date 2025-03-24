<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Sauce;

class UtilisateursReactionsSeeder extends Seeder
{
    public function run()
    {
        $sauce1 = Sauce::find(1);
        if ($sauce1) {
            $usersLiked = $sauce1->usersLiked;
            $usersLiked[] = 2;
            $usersLiked[] = 3;
            $sauce1->usersLiked = $usersLiked;
            $sauce1->likes += 2;
            $sauce1->save();
        }

        $sauce2 = Sauce::find(2);
        if ($sauce2) {
            $usersDisliked = $sauce2->usersDisliked;
            $usersDisliked[] = 3;
            $sauce2->usersDisliked = $usersDisliked;
            $sauce2->dislikes++;
            $sauce2->save();
        }

        $sauce3 = Sauce::find(3);
        if ($sauce3) {
            $usersLiked = $sauce3->usersLiked;
            $usersLiked[] = 2;
            $sauce3->usersLiked = $usersLiked;
            $sauce3->likes++;
            $sauce3->save();
        }

        $sauce4 = Sauce::find(4);
        if ($sauce4) {
        }

        $sauce5 = Sauce::find(5);
        if ($sauce5) {
            $usersDisliked = $sauce5->usersDisliked;
            $usersDisliked[] = 1;
            $sauce5->usersDisliked = $usersDisliked;
            $sauce5->dislikes++;
            $sauce5->save();
        }
    }
}
