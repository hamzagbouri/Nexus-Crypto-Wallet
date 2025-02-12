<?php

namespace App\Controller;

use App\core\Controller;
use App\Model\Session;
use App\Model\Watchlist;

class WatchListController extends Controller
{
    public function add($slug){
        $user_id = 1;
        Session::ActiverSession();
        if(!isset($_SESSION['userData']))
        {

            header('Location: /nexus-crypto-wallet/home/login');
        } else {
            Watchlist::add($user_id, $slug);
            header('Location: /nexus-crypto-wallet/home/watchlist');
        }

    }
    public function supprimer($slug){
        Watchlist::supprimer($slug);
        header('Location: /nexus-crypto-wallet/home/watchlist');

    }
    public function check($slug)
    {
        echo json_encode(Watchlist::checkCrypto( $slug, 1));

    }

}