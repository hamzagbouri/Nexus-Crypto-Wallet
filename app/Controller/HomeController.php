<?php

namespace App\Controller;

use App\core\Controller;
use App\Model\Watchlist;

class HomeController extends Controller
{
    public function index(){

        $this->view('index');
    }
    public function login()
    {
        echo 'login';
        $this->view('pages/login');
    }
    public function register()
    {
        echo 'register';
        $this->view('pages/signup');
    }
    public function top10()
    {
        echo 'top10';
        $this->view('pages/top10');
    }
    public function watchList()
    {
        // Récupérer les cryptos enregistrées dans la watchlist
        $watchlist = Watchlist::getAll(1); // Remplace 1 par l'ID de l'utilisateur dynamique

        // Récupérer les informations des cryptos via l'API
        $cryptoData = [];
        foreach ($watchlist->getCryptos() as $crypto) {

            $cryptoInfo = file_get_contents("http://localhost/Nexus-crypto-wallet/api/getcrypto/$crypto");
            $cryptoData[] = json_decode($cryptoInfo, true);
        }

        // Passer les données à la vue
        $this->view('pages/watchList', $cryptoData);
    }


}