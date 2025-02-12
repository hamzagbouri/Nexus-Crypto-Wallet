<?php
namespace App\Controller;

use App\Model\Wallet;
use PDO;
// use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;


class WalletController {
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function getWalletData($userId) {
      // Récupérer l'ID du portefeuille associé à l'utilisateur
      $wallet = new Wallet(null, $userId, $this->pdo); // Créer une instance de Wallet sans ID
      $walletId = $wallet->getWalletIdByUserId(); // Récupérer l'ID du portefeuille
  
      if (!$walletId) {
          return new JsonResponse(['error' => 'Wallet not found'], 404); // Gérer le cas où le portefeuille n'existe pas
      }
  
      // Créer une instance de Wallet avec l'ID récupéré
      $wallet = new Wallet($walletId, $userId, $this->pdo);
      $wallet->loadBalances(); // Charger les soldes des cryptomonnaies
  
      // Récupérer le solde en USDT
      $usdtBalance = $wallet->getUsdtBalance();
      // Récupérer les soldes des cryptomonnaies
      $cryptoBalances = $wallet->getAllBalances();
  
      // Préparer les données pour Chart.js
      $labels = array_keys($cryptoBalances);
      $data = array_values($cryptoBalances);
  
      return new JsonResponse([
          'usdt_balance' => $usdtBalance,
          'cryptos' => $cryptoBalances,
          'labels' => $labels,
          'data' => $data
      ]);
  }

    // public function getWalletData($userId) {
    //     $wallet = new Wallet(null, $userId, $this->pdo); 
    //     $walletId = $wallet->getWalletIdByUserId(); 

    //     if (!$walletId) {
    //         return new JsonResponse(['error' => 'Wallet not found'], 404); 
    //     }

        
    //     $wallet = new Wallet($walletId, $userId, $this->pdo);
    //     $wallet->loadBalances(); 

        
    //     $usdtBalance = $wallet->getUsdtBalance();
        
    //     $cryptoBalances = $wallet->getAllBalances();

    //     return new JsonResponse([
    //         'usdt_balance' => $usdtBalance,
    //         'cryptos' => $cryptoBalances
    //     ]);
    // }
}
?>