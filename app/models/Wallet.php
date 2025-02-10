<?php
class Wallet {
    private int $id;
    private User $user;
    private array $cryptos;

    public function __construct(int $id, User $user, array $cryptos = []) {
        $this->id = $id;
        $this->user = $user;
        $this->cryptos = $cryptos;
    }

    public function getId(): int { return $this->id; }
    public function getUser(): User { return $this->user; }
    public function getCryptos(): array { return $this->cryptos; }

    public function setId(int $id) { $this->id = $id; }
    public function setUser(User $user) { $this->user = $user; }
    public function setCryptos(array $cryptos) { $this->cryptos = $cryptos; }

    public function addCrypto(Crypto $crypto) { $this->cryptos[] = $crypto; }
    public function removeCrypto(Crypto $crypto) { 
        $this->cryptos = array_filter($this->cryptos, fn($c) => $c !== $crypto);
    }
}
?>