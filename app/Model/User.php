<?php
namespace App\Model;
class User {
    private $id;
    private $full_name;
    private $date_naissance;
    private $nexus_id;
    private $email;
    private $password;
    private $usdt_balance;

    public function __construct($id, $full_name, $date_naissance, $nexus_id, $email, $password, $usdt_balance) {
        $this->id = $id;
        $this->full_name = $full_name;
        $this->date_naissance = $date_naissance;
        $this->nexus_id = $nexus_id;
        $this->email = $email;
        $this->password = $password;
        $this->usdt_balance = $usdt_balance;
    }

    public function registre() {
        // Implementation
    }

    public function login() {
        // Implementation
    }

    public function getBalance() {
        // Implementation
        return $this->usdt_balance;  // Placeholder
    }

    public function updateBalance() {
        // Implementation
    }

    public function addToWatchList($crypto) {
        // Implementation
    }

    public function removeFromWatchlist($crypto) {
        // Implementation
    }

    public function getId() {
        return $this->id;
    }

    public function getFullName() {
        return $this->full_name;
    }

    public function getDateNaissance() {
        return $this->date_naissance;
    }

    public function getNexusId() {
        return $this->nexus_id;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getUsdtBalance() {
        return $this->usdt_balance;
    }

    public function setUsdtBalance($usdt_balance) {
        $this->usdt_balance = $usdt_balance;
    }
}
?>