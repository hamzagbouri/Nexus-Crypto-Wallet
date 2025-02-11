<?php
require_once 'User.php';
class Wallet {
    private $id;
    private $amount;
    private User $user; 

    public function __construct($id, $amount, User $user) {
        $this->id = $id;
        $this->amount = $amount;
        $this->user = $user;
    }

    public function getBlance($crypto) {
        // Implementation
        return $this->amount;  // Placeholder
    }

    public function addFunds($amount) {
        // Implementation
        $this->amount += $amount;
    }

    public function withdrawFunds($amount) {
        // Implementation
        $this->amount -= $amount;
    }

    public function transfersFunds($amount, $receiver, $crypto) {
        // Implementation
    }

    public function getId() {
        return $this->id;
    }

    public function getAmount() {
        return $this->amount;
    }

    public function getUser(): User {
        return $this->user;
    }
}
?>