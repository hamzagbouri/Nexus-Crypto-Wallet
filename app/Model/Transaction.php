<?php
namespace App\Model;
use App\Model\User;
use App\Model\Crypto;
class Transaction {
    private $id;
    private $amount;
    private $transaction_type;
    private $status;
    private $date;
    private $user;
    private $crypto;

    public function __construct($id, $amount, $transaction_type, $status, $date, $user_id = null, $crypto_id = null) {
        $this->id = $id;
        $this->amount = $amount;
        $this->transaction_type = $transaction_type;
        $this->status = $status;
        $this->date = $date;
        // Initialize the user and crypto objects if IDs are provided
        $this->user = ($user_id !== null) ? User::getById($user_id) : null;
        $this->crypto = $crypto_id;
    }


    public function executeTransaction() {
        // Implementation
    }

    public function buyCrypto() {
        // Implementation
    }

    public function sellCrypto() {
        // Implementation
    }

    public function sendCrypto() {
        // Implementation
    }

    public function getId() {
        return $this->id;
    }

    public function getAmount() {
        return $this->amount;
    }

    public function getTransactionType() {
        return $this->transaction_type;
    }

    public function getStatus() {
        return $this->status;
    }

    public function getDate() {
        return $this->date;
    }

    public function getUser(): User {
        return $this->user;
    }

    public function getCrypto(): Crypto {
        return $this->crypto;
    }
}
?>