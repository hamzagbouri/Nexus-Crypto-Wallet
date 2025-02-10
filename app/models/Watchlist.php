<?php
class Watchlist {
    private $id;
    private $user;
    private $cryptos;

    public function __construct($id, $user, $cryptos = []) {
        $this->id = $id;
        $this->user = $user;
        $this->cryptos = $cryptos;
    }

    public function getId() { return $this->id; }
    public function getUser() { return $this->user; }
    public function getCryptos() { return $this->cryptos; }

    public function setId($id) { $this->id = $id; }
    public function setUser($user) { $this->user = $user; }
    public function setCryptos($cryptos) { $this->cryptos = $cryptos; }

    public function addCrypto($crypto) { $this->cryptos[] = $crypto; }
    public function removeCrypto($crypto) { 
        $this->cryptos = array_filter($this->cryptos, function($c) use ($crypto) { return $c !== $crypto; });
    }
}
?>