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
        $stmt->bindParam(':userId', $userId);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)['usdt_balance'] ?? false;
    }

    public function getCryptoBalance($walletId, $cryptoId) {
        $query = "SELECT balance FROM wallet_cryptos WHERE wallet_id = :walletId AND crypto_id = :cryptoId";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':walletId', $walletId);
        $stmt->bindParam(':cryptoId', $cryptoId);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)['balance'] ?? false;
    }
    public function createTransaction($userId, $cryptoId, $amount, $reseved_user, $transactionType, $status, $cryptoPrice) {
        if ($transactionType == 'send') {
            $query = "INSERT INTO transactions (sender_id, crypto_id, amount, transaction_type, id_resever, status, user_id, price) 
            VALUES (:userId, :cryptoId, :amount, :transactionType, :id_resever, :status, :userId, :cryptoPrice) 
            RETURNING id";
        } else {
            $query = "INSERT INTO transactions (sender_id, crypto_id, amount, transaction_type, status, user_id, price) 
            VALUES (:userId, :cryptoId, :amount, :transactionType, :status, :userId, :cryptoPrice) 
            RETURNING id";
        }
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':userId', $userId);
        $stmt->bindParam(':cryptoId', $cryptoId);
        $stmt->bindParam(':amount', $amount);
        $stmt->bindParam(':transactionType', $transactionType);
        if ($reseved_user !== null) {
        $stmt->bindParam(':id_resever', $reseved_user, PDO::PARAM_INT);
        } else {
            $stmt->bindValue(':id_resever', null, PDO::PARAM_NULL);
        }
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':cryptoPrice', $cryptoPrice);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)['id'];
    }
    
    public function updateUserBalance($userId, $amount,$type) {
        if($type=='buy'){
            $query = "UPDATE users SET usdt_balance = usdt_balance + :amount WHERE id = :userId";
        }
        elseif($type=='sell'){
        $query = "UPDATE users SET usdt_balance = usdt_balance + :amount WHERE id = :userId";      
        }
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':amount', $amount);
        $stmt->bindParam(':userId', $userId);
        return $stmt->execute();
    }
    public function getWalletIdByUser($userId) {
        $query = "SELECT id FROM wallets WHERE user_id = :userId";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':userId', $userId);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $result ? $result['id'] : null; 
    }
    
    public function updateWalletCryptos($walletId, $cryptoId, $amount) {
        $query = "INSERT INTO wallet_cryptos (wallet_id, crypto_id, balance) 
        VALUES (:walletId, :cryptoId, :amount)
        ON CONFLICT (wallet_id, crypto_id)
        DO UPDATE SET balance = wallet_cryptos.balance + :amount";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':walletId', $walletId);
        $stmt->bindParam(':cryptoId', $cryptoId);
        $stmt->bindParam(':amount', $amount);
        return $stmt->execute();
    }

    public function updateTransactionStatus($transactionId, $status) {
        $query = "UPDATE transactions SET status = :status WHERE id = :transactionId";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':transactionId', $transactionId);
        return $stmt->execute();
    }
}
?>
