<?php
namespace App\Model;
use App\Model\User;
use App\Model\Crypto;
use PDO;
use PDOException;
class Transaction {
    private $pdo;

    public function __construct() {
        $this->pdo = Database::getInstance()->getConnection();
    }
    public function getUserBalance($userId) {
        $stmt = $this->pdo->prepare("SELECT usdt_balance FROM users WHERE id_user = :userId");
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    public function getCryptoIdByName($cryptoName) {
        $stmt = $this->pdo->prepare("SELECT id FROM cryptos WHERE name = :cryptoName");
        $stmt->bindParam(':cryptoName', $cryptoName, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    public function getWalletIdByUser($userId) {
        $stmt = $this->pdo->prepare("SELECT id FROM wallets WHERE id_user = :userId");
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    public function createTransaction($userId, $cryptoId, $amount, $action, $status, $price) {
        try {
                $stmt = $this->pdo->prepare("INSERT INTO transaction (id_user, id_crypto, amount, date_transaction, transaction_type, status, price_crypto) 
                VALUES (:userId, :cryptoId, :amount, NOW(), :action, :status, :price)");
        
            // elseif($action=='Sell'){
            //     $stmt = $this->pdo->prepare("INSERT INTO transaction (id_user, id_crypto, amount, transaction_date, transaction_type, status, price) 
            //     VALUES (:userId, :cryptoId, :amount, NOW(), :action, :status, :price)")
            // }
            $stmt->bindParam(':userId', $userId);
            $stmt->bindParam(':cryptoId', $cryptoId);
            $stmt->bindParam(':amount', $amount);
            $stmt->bindParam(':action', $action);
            $stmt->bindParam(':status', $status);
            $stmt->bindParam(':price', $price);
            
            if ($stmt->execute()) {
                return $this->pdo->lastInsertId();
            } else {
                $errorInfo = $stmt->errorInfo();
                error_log("Transaction failed: " . print_r($errorInfo, true));
                return false;
            }
        } catch (PDOException $e) {
            error_log("Error in createTransaction: " . $e->getMessage());
            return false;
        }
    }
    
    public function updateUserBalance($userId, $amountChange, $action) {
        $stmt = $this->pdo->prepare("UPDATE users SET balance = balance + :amountChange WHERE id_user = :userId");
        $stmt->bindParam(':amountChange', $amountChange);
        $stmt->bindParam(':userId', $userId);
        $stmt->execute();
    }

    public function updateWalletCryptos($walletId, $cryptoId, $amountChange) {
        $stmt = $this->pdo->prepare("UPDATE wallet_cryptos SET amount = amount + :amountChange WHERE wallet_id = :walletId AND crypto_id = :cryptoId");
        $stmt->bindParam(':amountChange', $amountChange);
        $stmt->bindParam(':walletId', $walletId);
        $stmt->bindParam(':cryptoId', $cryptoId);
        $stmt->execute();
    }

    public function getCryptoBalance($walletId, $cryptoId) {
        $stmt = $this->pdo->prepare("SELECT amount FROM wallet_cryptos WHERE wallet_id = :walletId AND crypto_id = :cryptoId");
        $stmt->bindParam(':walletId', $walletId);
        $stmt->bindParam(':cryptoId', $cryptoId);
        $stmt->execute();
        return $stmt->fetchColumn();
    }
}