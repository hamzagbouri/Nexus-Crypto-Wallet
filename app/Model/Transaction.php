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
    
        public function getWalletIdByUser($userId) {
            $stmt = $this->pdo->prepare("SELECT id_wallet FROM wallet WHERE id_user = :userId");
            $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchColumn();
        }
    
        public function createTransaction($userId, $cryptoId, $amount, $action, $status, $price) {
            $stmt = $this->pdo->prepare("INSERT INTO transaction (id_user, id_crypto, amount, date_transaction, transaction_type, status, prix_crypto) 
                VALUES (:userId, :cryptoId, :amount, NOW(), :action, :status, :price)");
    
            $stmt->bindParam(':userId', $userId);
            $stmt->bindParam(':cryptoId', $cryptoId);
            $stmt->bindParam(':amount', $amount);
            $stmt->bindParam(':action', $action);
            $stmt->bindParam(':status', $status);
            $stmt->bindParam(':price', $price);
    
            if ($stmt->execute()) {
                return $this->pdo->lastInsertId();
            }
            return false;
        }
    
        public function updateUserBalance($userId, $amountChange) {
            $stmt = $this->pdo->prepare("UPDATE users SET usdt_balance = usdt_balance + :amountChange WHERE id_user = :userId");
            $stmt->bindParam(':amountChange', $amountChange);
            $stmt->bindParam(':userId', $userId);
            return $stmt->execute();
        }
    
        public function updateOrInsertWalletCrypto($walletId, $cryptoId, $amount) {
            $stmt = $this->pdo->prepare("SELECT amount FROM wallet_crypto WHERE id_wallet = :walletId AND id_crypto = :cryptoId");
            $stmt->bindParam(':walletId', $walletId, PDO::PARAM_INT);
            $stmt->bindParam(':cryptoId', $cryptoId, PDO::PARAM_STR);
            $stmt->execute();
            $existingRecord = $stmt->fetch(PDO::FETCH_ASSOC);
    
            if ($existingRecord) {
                $stmt = $this->pdo->prepare("UPDATE wallet_crypto SET amount = amount + :amount WHERE id_wallet = :walletId AND id_crypto = :cryptoId");
                $stmt->bindParam(':amount', $amount, PDO::PARAM_STR);
                $stmt->bindParam(':walletId', $walletId, PDO::PARAM_INT);
                $stmt->bindParam(':cryptoId', $cryptoId, PDO::PARAM_STR);
                return $stmt->execute();
            } else {
                $stmt = $this->pdo->prepare("INSERT INTO wallet_crypto (id_wallet, id_crypto, amount) VALUES (:walletId, :cryptoId, :amount)");
                $stmt->bindParam(':walletId', $walletId, PDO::PARAM_INT);
                $stmt->bindParam(':cryptoId', $cryptoId, PDO::PARAM_STR);
                $stmt->bindParam(':amount', $amount, PDO::PARAM_STR);
                return $stmt->execute();
            }
        }
    
        public function getCryptoBalance($userId, $cryptoId) {
            $stmt = $this->pdo->prepare(
                "SELECT wc.amount FROM wallet_crypto wc
                INNER JOIN wallet w ON wc.id_wallet = w.id_wallet
                WHERE w.id_user = :userId AND wc.id_crypto = :cryptoId"
            );
            $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
            $stmt->bindParam(':cryptoId', $cryptoId, PDO::PARAM_STR);
            $stmt->execute();
            $amount = $stmt->fetchColumn();
            return $amount !== false ? $amount : 0;
        }
    }