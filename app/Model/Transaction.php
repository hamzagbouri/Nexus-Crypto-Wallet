<?php
namespace App\Model;
use App\Model\User;
use App\Model\Crypto;
use PDO;

class Transaction {
    private $pdo;
    
    public function __construct() {
        $this->pdo = Database::getInstance()->getConnection();
    }
    
    public function getUserBalance($userId) {
        $query = "SELECT usdt_balance FROM users WHERE id = :userId";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':userId',$userId);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)['usdt_balance'] ?? false;
    }
    
    public function getCryptoBalance($walletId, $cryptoId) {
        $query = "SELECT balance FROM wallet_cryptos WHERE wallet_id = :walletId AND crypto_id = :cryptoId";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':walletId',$walletId);
        $stmt->bindParam(':cryptoId',$cryptoId);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)['balance'] ?? false;
    }
    
    
    public function createTransaction($senderId, $cryptoId, $amount, $type) {
        $query = "INSERT INTO transactions (sender_id, crypto_id, amount, transaction_type, status) 
                 VALUES (:senderId, :cryptoId, :amount, :type, 'pending') RETURNING id";
        $stmt = $this->pdo->prepare($query);

        $stmt->execute([$senderId, $cryptoId, $amount, $type]);
        return $stmt->fetch(PDO::FETCH_ASSOC)['id'];
    }
    
    public function updateUserBalance($userId, $amount) {
        $query = "UPDATE users SET usdt_balance = usdt_balance + $1 WHERE id = $2";
        $stmt = $this->pdo->prepare($query);
        return $stmt->execute([$amount, $userId]);
    }
    
    public function updateCryptoBalance($walletId, $cryptoId, $amount) {
        $query = "INSERT INTO wallet_cryptos (wallet_id, crypto_id, balance) 
                 VALUES ($1, $2, $3)
                 ON CONFLICT (wallet_id, crypto_id) 
                 DO UPDATE SET balance = wallet_cryptos.balance + $3";
        $stmt = $this->pdo->prepare($query);
        return $stmt->execute([$walletId, $cryptoId, $amount]);
    }
    
    public function updateTransactionStatus($transactionId, $status) {
        $query = "UPDATE transactions SET status = $1 WHERE id = $2";
        $stmt = $this->pdo->prepare($query);
        return $stmt->execute([$status, $transactionId]);
    }
    
    public function buyCrypto($userId, $cryptoId, $amount) {
        
            $price = $this->getCryptoPrice($cryptoId);
            $costInUsdt = $price * $amount;
            $userBalance = $this->getUserBalance($userId);
            
            if ($userBalance < $costInUsdt) {
                $this->pdo->rollBack();
                return ['success' => false, 'message' => 'Insufficient balance'];
            }
            
            $transactionId = $this->createTransaction($userId, $cryptoId, $amount, 'buy','complited',);
            
            $walletQuery = "SELECT id FROM wallets WHERE user_id = $1";
            $stmt = $this->pdo->prepare($walletQuery);
            $stmt->execute([$userId]);
            $walletId = $stmt->fetch(PDO::FETCH_ASSOC)['id'];
            
            $this->updateUserBalance($userId, -$costInUsdt);
            $this->updateCryptoBalance($walletId, $cryptoId, $amount);
            $this->updateTransactionStatus($transactionId, 'completed');
            
            $this->pdo->commit();
            return ['success' => true, 'transaction_id' => $transactionId];
            
    }
    
    public function sellCrypto($userId, $cryptoId, $amount) {
       
    }
}
?>
