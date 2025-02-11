<?php
namespace App\Model;
class Watchlist {
    private $id;
    private  $user;
    
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