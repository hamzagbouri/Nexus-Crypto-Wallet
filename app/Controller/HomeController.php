<?php

namespace App\Controller;

use App\core\Controller;
use App\Model\Session;
use App\Model\Wallet;
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
        Session::ActiverSession();
        $user = unserialize($_SESSION['userData']);
        echo $user->getUsdtBalance();
        $wallet = unserialize($_SESSION['wallet']);
        $cryptosWallet = $wallet->getAllBalances();
        $watchlist = Watchlist::getAll($user->getId()); // Remplace 1 par l'ID de l'utilisateur dynamique

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
                $decodedData['cryptosWallet'] = $cryptosWallet;
                $cryptoData[] = $decodedData;
            }
        }
        }

        // Passer les données à la vue
        $this->view('pages/watchList', $cryptoData);
      
    }

    public function verify($user){
        Session::ActiverSession();
print_r($_SESSION);
        $this->view('pages/verify_code',$user);
    }
    public function transaction()
    {
        $this->view('pages/transaction');
    }
    public function wallet() {
        Session::ActiverSession();
        $user = unserialize($_SESSION['userData']);
        $user_id = $user->getId();
        $data['user'] = $user;
        $data['balance'] = $user->getUsdtBalance();
        $data['cryptos'] = Wallet::getWalletForUser($user_id);
        if(!isset($_SESSION['wallet'])){
            $_SESSION['wallet'] =$data['cryptos'];
        }
        $this->view('pages/wallet',$data);
    }

}