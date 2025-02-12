<?php

namespace App\Controller;

use App\core\Controller;
use App\Model\Watchlist;

class HomeController extends Controller
{
    public function index(){

     
        $this->view('index');
    }
    public  function login()
    {
      
        $this->view('pages/login');
    }
    public function register()
    {
       
        $this->view('pages/signup');
    }
    
    public function top10()
    {

        
        $this->view('pages/top10');
    }
    public function watchList()
    {
        // Récupérer les cryptos enregistrées dans la watchlist
        $watchlist = Watchlist::getAll(1); // Remplace 1 par l'ID de l'utilisateur dynamique

        // Récupérer les informations des cryptos via l'API
        $cryptoData = [];
        if(!empty($watchlist))
        {
        foreach ($watchlist->getCryptos() as $crypto) {

            $cryptoInfo = file_get_contents("http://localhost/Nexus-crypto-wallet/api/getcrypto/$crypto");
            $decodedData = json_decode($cryptoInfo, true);

            if ($decodedData) {
                $price = $decodedData['description'];
                // Extract price and change percentage using regex
                if (preg_match('/The last known price of .* is ([\d,.]+) USD and is (down|up) ([\d.-]+) over the last 24 hours./', $price, $matches)) {
                    $cryptoPrice = $matches[1]; // Extracted price
                    $change24h = ($matches[2] === 'down' ? '-' : '+') . $matches[3]; // Change with sign
                } else {
                    $cryptoPrice = "N/A";
                    $change24h = "N/A";
                }

                // Add slug and extracted values
                $decodedData['slug'] = $crypto;
                $decodedData['price'] = $cryptoPrice;
                $decodedData['change_24h'] = $change24h;

                $cryptoData[] = $decodedData;
            }

        }
        }

        // Passer les données à la vue
        $this->view('pages/watchList', $cryptoData);
      
        $this->view('pages/watchList');
    }

    public function verify(){
        $this->view('pages/verify_code');
    }

}