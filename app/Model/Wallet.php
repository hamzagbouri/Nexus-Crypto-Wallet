<?php
namespace App\Model;

class Wallet {
    private $id;
    private $balances; // Array of crypto balances
    private $user;

    public function __construct($id, User $user, array $balances = []) {
        $this->id = $id;
        $this->user = $user;
        $this->balances = $balances; // Format: ['BTC' => 0.5, 'ETH' => 2.0]
    }

    public function getBalance($cryptoSymbol) {
        return $this->balances[$cryptoSymbol] ?? 0; // Return 0 if crypto not found
    }

    public function addFunds($cryptoSymbol, $amount) {
        if (!isset($this->balances[$cryptoSymbol])) {
            $this->balances[$cryptoSymbol] = 0; // Initialize if not present
        }
        $this->balances[$cryptoSymbol] += $amount;
    }

    public function withdrawFunds($cryptoSymbol, $amount) {
        if (!isset($this->balances[$cryptoSymbol]) || $this->balances[$cryptoSymbol] < $amount) {
            throw new \Exception("Insufficient balance for $cryptoSymbol");
        }
        $this->balances[$cryptoSymbol] -= $amount;
    }

    public function transferFunds($cryptoSymbol, $amount, Wallet $receiver) {
        $this->withdrawFunds($cryptoSymbol, $amount); // Deduct from sender
        $receiver->addFunds($cryptoSymbol, $amount); // Add to receiver
    }

    public function getId() {
        return $this->id;
    }

    public function getUser() {
        return $this->user;
    }

    public function getAllBalances() {
        return $this->balances;
    }
}
?>
