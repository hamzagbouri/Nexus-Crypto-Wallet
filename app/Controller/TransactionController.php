<?php 

namespace App\Controller;

use App\Model\Transaction;
use App\Model\User;
use App\Model\Crypto;
use PDO;

class TransactionController {
    private $transaction;
    private $user;
    private $crypto;
    private $pdo;

    public function __construct($user_id, $crypto_id, $amount, $transaction_type, $price) {
        $this->user = new User($user_id);
        $this->crypto = new Crypto($crypto_id);
        $this->transaction = new Transaction(null, $amount, $transaction_type, 'pending', date('Y-m-d H:i:s'), $user_id, $crypto_id);
    }

    public function processBuyTransaction() {
        if ($this->transaction->buyCrypto()) {
            $this->transaction->setStatus('completed');
            return true;
        } else {
            $this->transaction->setStatus('failed');
            return false;
        }
    }

    public function processSellTransaction() {
        if ($this->transaction->sellCrypto()) {
            $this->transaction->setStatus('completed');
            return true;
        } else {
            $this->transaction->setStatus('failed');
            return false;
        }
    }

    public function getTransactionDetails() {
        return [
            'id' => $this->transaction->getId(),
            'amount' => $this->transaction->getAmount(),
            'transaction_type' => $this->transaction->getTransactionType(),
            'status' => $this->transaction->getStatus(),
            'date' => $this->transaction->getDate()
        ];
    }
}
