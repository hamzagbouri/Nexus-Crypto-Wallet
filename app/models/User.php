<?php

class User {
    private $id;
    private $nom;
    private $prenom;
    private $date_naissance;
    private $nexus_id;
    private $email;
    private $password;
    private $usdt_balance;

    public function __construct($id, $nom, $prenom, $date_naissance, $nexus_id, $email, $password, $usdt_balance) {
        $this->id = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->date_naissance = $date_naissance;
        $this->nexus_id = $nexus_id;
        $this->email = $email;
        $this->password = $password;
        $this->usdt_balance = $usdt_balance;
    }

    public function getId() { return $this->id; }
    public function getNom() { return $this->nom; }
    public function getPrenom() { return $this->prenom; }
    public function getDateNaissance() { return $this->date_naissance; }
    public function getNexusId() { return $this->nexus_id; }
    public function getEmail() { return $this->email; }
    public function getPassword() { return $this->password; }
    public function getUsdtBalance() { return $this->usdt_balance; }

    public function setNom($nom) { $this->nom = $nom; }
    public function setPrenom($prenom) { $this->prenom = $prenom; }
    public function setDateNaissance($date_naissance) { $this->date_naissance = $date_naissance; }
    public function setNexusId($nexus_id) { $this->nexus_id = $nexus_id; }
    public function setEmail($email) { $this->email = $email; }
    public function setPassword($password) { $this->password = $password; }
    public function setUsdtBalance($usdt_balance) { $this->usdt_balance = $usdt_balance; }
}

?>