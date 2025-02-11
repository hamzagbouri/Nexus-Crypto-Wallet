<?php
require_once 'User.php';
require_once 'Crypto.php';
class Transaction {
    private $id;
    private $amount;
    private $transaction_type;
    private $status;
    private $date;
    private User $user;  
    private Crypto $crypto; 

    public function __construct($id, $amount, $transaction_type, $status, $date, User $user, Crypto $crypto) {
        $this->id = $id;
        $this->amount = $amount;
        $this->transaction_type = $transaction_type;
        $this->status = $status;
        $this->date = $date;
        $this->user = $user;
        $this->crypto = $crypto;
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