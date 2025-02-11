<?php
require_once 'User.php';
class Watchlist {
    private $id;
    private User $user; 
    
    public function __construct($id, User $user) {
        $this->id = $id;
        $this->user = $user;
    }

    public function addCrypto($crypto) {
        // Implementation
    }

    public function removeCrypto($crypto) {
        // Implementation
    }

    public function getId() {
        return $this->id;
    }

    public function getUser(): User {
        return $this->user;
    }
}
?>