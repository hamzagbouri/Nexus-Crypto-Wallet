<?php
namespace App\Model;

use PDO;

class Wallet {
    private $id; // ID du portefeuille
    private $userId; // ID de l'utilisateur
    private $pdo; // Instance PDO pour la connexion à la base de données
    private $balances; // Array of crypto balances

    public function __construct($id, $userId, PDO $pdo, array $balances = []) {
        $this->id = $id; // Initialisation de l'ID du portefeuille
        $this->userId = $userId; // Initialisation de l'ID de l'utilisateur
        $this->pdo = $pdo; // Initialisation de l'instance PDO
        $this->balances = $balances; // Format: ['BTC' => 0.5, 'ETH' => 2.0]
    }

    // Récupérer le solde en USDT de l'utilisateur
    public function getUsdtBalance() {
        $stmt = $this->pdo->prepare("SELECT usdt_balance FROM users WHERE id = :user_id");
        $stmt->execute(['user_id' => $this->userId]);
        return $stmt->fetchColumn(); // Retourne le solde USDT
    }

    // Récupérer les cryptomonnaies et leurs soldes
    public function getCryptoBalances() {
        $stmt = $this->pdo->prepare("
            SELECT c.symbol, wc.balance
            FROM wallet_cryptos wc
            JOIN cryptos c ON wc.crypto_id = c.id
            WHERE wc.wallet_id = :wallet_id
        ");
        $stmt->execute(['wallet_id' => $this->id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Retourne un tableau associatif des soldes des cryptomonnaies
    }

    // Récupérer le solde d'une cryptomonnaie spécifique
    public function getBalance($cryptoSymbol) {
        return $this->balances[$cryptoSymbol] ?? 0; // Retourne 0 si la cryptomonnaie n'est pas trouvée
    }

    // Ajouter des fonds à une cryptomonnaie
    public function addFunds($cryptoSymbol, $amount) {
        if (!isset($this->balances[$cryptoSymbol])) {
            $this->balances[$cryptoSymbol] = 0; // Initialiser si non présent
        }
        $this->balances[$cryptoSymbol] += $amount; // Ajouter le montant
    }

    // Retirer des fonds d'une cryptomonnaie
    public function withdrawFunds($cryptoSymbol, $amount) {
        if (!isset($this->balances[$cryptoSymbol]) || $this->balances[$cryptoSymbol] < $amount) {
            throw new \Exception("Insufficient balance for $cryptoSymbol"); // Lancer une exception si le solde est insuffisant
        }
        $this->balances[$cryptoSymbol] -= $amount; // Retirer le montant
    }

    // Transférer des fonds à un autre portefeuille
    public function transferFunds($cryptoSymbol, $amount, Wallet $receiver) {
        $this->withdrawFunds($cryptoSymbol, $amount); // Déduire du portefeuille de l'expéditeur
        $receiver->addFunds($cryptoSymbol, $amount); // Ajouter au portefeuille du destinataire
    }

    // Obtenir l'ID du portefeuille
    public function getId() {
        return $this->id;
    }

    // Obtenir l'ID de l'utilisateur
    public function getUserId() { // Correction ici
        return $this->userId;
    }

    // Obtenir tous les soldes
    public function getAllBalances() {
        return $this->balances; // Retourner tous les soldes
    }

    // Charger les soldes des cryptomonnaies depuis la base de données
    public function loadBalances() {
        $cryptoBalances = $this->getCryptoBalances(); // Récupérer les soldes des cryptomonnaies
        foreach ($cryptoBalances as $crypto) {
            $this->addFunds($crypto['symbol'], $crypto['balance']); // Ajouter chaque solde au tableau des soldes
        }
    }

    // Récupérer l'ID du portefeuille associé à l'utilisateur
    public function getWalletIdByUserId() { // Correction ici
        $stmt = $this->pdo->prepare("SELECT id FROM wallets WHERE user_id = :user_id");
        $stmt->execute(['user_id' => $this->userId]);
        return $stmt->fetchColumn(); // Retourne l'ID du portefeuille
    }
}
// namespace App\Model;

// class Wallet {
//     private $id;
//     private $balances; 
//     private $user;

//     public function __construct($id, User $user, array $balances = []) {
//         $this->id = $id;
//         $this->user = $user;
//         $this->balances = $balances; 
//     }

//     public function getBalance($cryptoSymbol) {
//         return $this->balances[$cryptoSymbol] ?? 0; 
//     }

//     public function addFunds($cryptoSymbol, $amount) {
//         if (!isset($this->balances[$cryptoSymbol])) {
//             $this->balances[$cryptoSymbol] = 0; 
//         }
//         $this->balances[$cryptoSymbol] += $amount;
//     }

//     public function withdrawFunds($cryptoSymbol, $amount) {
//         if (!isset($this->balances[$cryptoSymbol]) || $this->balances[$cryptoSymbol] < $amount) {
//             throw new \Exception("Insufficient balance for $cryptoSymbol");
//         }
//         $this->balances[$cryptoSymbol] -= $amount;
//     }

//     public function transferFunds($cryptoSymbol, $amount, Wallet $receiver) {
//         $this->withdrawFunds($cryptoSymbol, $amount); 
//         $receiver->addFunds($cryptoSymbol, $amount); 
//     }

//     public function getId() {
//         return $this->id;
//     }

//     public function getUser() {
//         return $this->user;
//     }

//     public function getAllBalances() {
//         return $this->balances;
//     }
// }
?>
