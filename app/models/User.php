<?php

class User {
    private int $id;
    private string $nom;
    private string $prenom;
    private string $date_naissance;
    private string $nexus_id;
    private string $email;
    private string $password;
    private float $usdt_balance;

    public function __construct(int $id, string $nom, string $prenom, string $date_naissance, string $nexus_id, string $email, string $password, float $usdt_balance) {
        $this->id = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->date_naissance = $date_naissance;
        $this->nexus_id = $nexus_id;
        $this->email = $email;
        $this->password = $password;
        $this->usdt_balance = $usdt_balance;
    }

    public function getId(): int { return $this->id; }
    public function getNom(): string { return $this->nom; }
    public function getPrenom(): string { return $this->prenom; }
    public function getDateNaissance(): string { return $this->date_naissance; }
    public function getNexusId(): string { return $this->nexus_id; }
    public function getEmail(): string { return $this->email; }
    public function getPassword(): string { return $this->password; }
    public function getUsdtBalance(): float { return $this->usdt_balance; }

    public function setNom(string $nom) { $this->nom = $nom; }
    public function setPrenom(string $prenom) { $this->prenom = $prenom; }
    public function setDateNaissance(string $date_naissance) { $this->date_naissance = $date_naissance; }
    public function setNexusId(string $nexus_id) { $this->nexus_id = $nexus_id; }
    public function setEmail(string $email) { $this->email = $email; }
    public function setPassword(string $password) { $this->password = $password; }
    public function setUsdtBalance(float $usdt_balance) { $this->usdt_balance = $usdt_balance; }
}

?>