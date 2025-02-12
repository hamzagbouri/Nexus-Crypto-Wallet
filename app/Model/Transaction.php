<?php
namespace App\Model;
use App\Model\User;
use App\Model\Crypto;
use App\Model;
use PDO;

class Transaction {
    private $id;
    private $amount;
    private $transaction_type;
    private $status;
    private $date;
    private $user_id;
    private $crypto_id;
    private $user;
    private $crypto;
    private $pdo;

    public function __construct($id, $amount, $transaction_type, $status, $date, $user_id = null, $crypto_id = null) {
        $this->id = $id;
        $this->amount = $amount;
        $this->transaction_type = $transaction_type;
        $this->status = $status;
        $this->date = $date;
        $this->user_id = $user_id;
        $this->crypto_id = $crypto_id;
        
        $this->user = ($user_id !== null) ? User::getById($user_id) : null;
        $this->crypto = ($crypto_id !== null) ? Crypto::getById($crypto_id) : null;
        
        $this->pdo =Database::getInstance();
    }

    public function getBalance($userId) {
        $query = "SELECT usdt_balance FROM users WHERE id = :id_user";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue(':id_user', $userId);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result ? $result['usdt_balance'] : false;
    }

    public function updateBalance($userId, $payment) {
        $query = "UPDATE users SET usdt_balance = usdt_balance - :payment WHERE id = :user_id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue('payment', $payment);
        $stmt->bindValue('user_id', $userId);
        return $stmt->execute();
    }

    public function updateCrypto($userId, $slug, $payment) {
        $query = "UPDATE wallets SET balance = balance + :payment WHERE user_id = :user_id AND slug = :slug";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue('payment', $payment);
        $stmt->bindValue('user_id', $userId);
        $stmt->bindValue('slug', $slug);
        return $stmt->execute();
    }

    public function calcAmountToPayInUSDT($price, $amount) {
        return $price * $amount;
    }

    public function calcCryptoForUSDT($price, $usdtAmount) {
        return $usdtAmount / $price;
    }

    public function processTransaction($userId, $slug, $price, $amount, $isPayingWithUSDT) {
        if ($isPayingWithUSDT) {
            $cryptoAmount = $this->calcCryptoForUSDT($price, $amount);

            $balance = $this->getBalance($userId);

            if ($balance >= $amount) {
                $this->updateCrypto($userId, $slug, $cryptoAmount);
                $this->updateBalance($userId, $amount);
                return true;
            } else {
                return false;  
            }
        } else {
            $usdtAmount = $this->calcAmountToPayInUSDT($price, $amount);

            $balance = $this->getBalance($userId);

            if ($balance >= $usdtAmount) {
                $this->updateCrypto($userId, $slug, $amount);
                $this->updateBalance($userId, $usdtAmount);
                return true;
            } else {
                return false;
            }
        }
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getAmount() {
        return $this->amount;
    }

    public function setAmount($amount) {
        $this->amount = $amount;
    }

    public function getTransactionType() {
        return $this->transaction_type;
    }

    public function setTransactionType($transaction_type) {
        $this->transaction_type = $transaction_type;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

    public function getDate() {
        return $this->date;
    }

    public function setDate($date) {
        $this->date = $date;
    }

    public function getUser() {
        return $this->user;
    }

    public function setUser($user) {
        $this->user = $user;
    }

    public function getCrypto() {
        return $this->crypto;
    }

    public function setCrypto($crypto) {
        $this->crypto = $crypto;
    }

    public function getUserId() {
        return $this->user_id;
    }

    public function setUserId($user_id) {
        $this->user_id = $user_id;
    }

    public function getCryptoId() {
        return $this->crypto_id;
    }

    public function setCryptoId($crypto_id) {
        $this->crypto_id = $crypto_id;
    }
}
?>
