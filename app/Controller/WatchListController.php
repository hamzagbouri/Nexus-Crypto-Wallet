<?php

namespace App\Controller;

use App\core\Controller;
use App\Model\Watchlist;

class WatchListController extends Controller
{
    public function add($slug){
        $user_id = 1;
        echo $slug;
        echo "<br>";
        Watchlist::add($user_id, $slug);
    }

}