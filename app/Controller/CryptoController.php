<?php

namespace App\Controller;

use App\core\Controller;
use App\Model\Crypto;

class CryptoController extends Controller
{


    public function buy($params)
    {
        $id_crypto = $_POST['crypto'];
        $amount = $_POST['cryptoAmount'];
        $price = $_POST['cPrice'];

        $crypto = new Crypto();
        $crypto->buy($id_crypto, $amount, $price);


    }
    public function sell($params)
    {
        $id_crypto = $_POST['crypto'];
        $amount = $_POST['cryptoAmount'];
        $price = $_POST['cPrice'];
        $crypto = new Crypto();
        $crypto->sell($id_crypto, $amount, $price);

    }
    public function transation()
    {
       if($_POST['action'] == 'sell')
       {
                $this->sell($_POST);

       } else if  ($_POST['action'] == 'buy' )
       {
          $this->buy($_POST);
       }
        header('Location: /nexus-crypto-wallet/home/watchList');
    }
    public function sellAll()
    {
        print_r($_POST);
    }
    public function send()
    {
        $crypto = new Crypto();
        $receiver = $_POST['receiver'];
        $amount = $_POST['amount'];
        $slug = $_POST['slug'];
        print_r($_POST);

            var_dump($crypto->send($receiver, $slug, $amount));


        header('Location: /nexus-crypto-wallet/home/transaction');

    }


}