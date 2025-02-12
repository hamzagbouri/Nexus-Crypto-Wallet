<?php
namespace App\Model;
use PDO;
use PDOException;

class User {
    private $id;
    private $nom;
    private $prenom;
    private $date_naissance;
    private $nexus_id;
    private $email;
    private $password;
    private $usdt_balance;

    public function __construct($id, $nom,$prenom, $date_naissance,  $email, $password, $usdt_balance) {
        $this->id = $id;
        $this->nom = $nom;
        $this->prenom=$prenom;
        $this->date_naissance = $date_naissance;
        $this->nexus_id = $this->GenerNexus_ID();
        $this->email = $email;
        $this->password =  $this->hashPassword($password);;
        $this->usdt_balance = $usdt_balance;
    }

    private function GenerNexus_ID() {
        $nexus_id='NC' . str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT);
        if($this->verifyNexusID($nexus_id)){
           $nexus_id= $this->GenerNexus_ID();
        }
        return $nexus_id;
    }
    private function hashPassword($password) {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    

    // Vérification si le Nexus ID existe 
    private function verifyNexusID($nexus_id) {
        $db=Database::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT COUNT(*) FROM users WHERE nexus_id = :nexus_id");
        $stmt->bindParam(':nexus_id', $nexus_id, PDO::PARAM_STR);
        $stmt->execute();
        
        // Si le Nexus ID existe on retourne true 
        $count = $stmt->fetchColumn();
        return $count > 0;
    }

    public static function verifyEmail($email) {
      
        $db = Database::getInstance()->getConnection();
        
       
        $stmt = $db->prepare("SELECT COUNT(*) FROM users WHERE email = :email");
       
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        
       
        $stmt->execute();
        
       
        $count = $stmt->fetchColumn();
        
       
        return $count > 0;
    }
    
    public static function registre($nom, $prenom, $date_naissance, $email, $password, $usdt_balance) {
        // Vérifier si l'email est déjà pris
        if (self::verifyEmail($email)) {
            return "Cet email est déjà utilisé.";
        }

        
       

       
        $user = new User(null, $nom , $prenom, $date_naissance, $email, $password, $usdt_balance);

        
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("INSERT INTO users (nom,prenom, date_naissance, nexus_id, email, password, usdt_balance) 
                              VALUES (:nom,:prenom, :date_naissance, :nexus_id, :email, :password, :usdt_balance)");

        $stmt->bindParam(':nom', $user->nom);
        $stmt->bindParam(':prenom', $user->prenom);
        $stmt->bindParam(':date_naissance', $user->date_naissance);
        $stmt->bindParam(':nexus_id', $user->nexus_id);
        $stmt->bindParam(':email', $user->email);
        $stmt->bindParam(':password', $user->password);
        $stmt->bindParam(':usdt_balance', $user->usdt_balance);

        // Exécuter la requête
        $stmt->execute();

        // Retourner un message de succès
        return "Utilisateur enregistré avec succès!";
    }

    public static function getUserByEmail($email){
       
        $db=Database::getInstance()->getConnection();
        try{
          $stmt=$db->prepare("select * From users where email=:email");
          $stmt->bindParam(':email', $email);
          $result=$stmt->execute();
          if($result){
             return new user($result['id'],$result['nom'],$result['prenom'],$result['date_naissance'],$result['email'],$result['password'],$result['usdt_balance']);
          }
              return null;

        }catch(PDOException $e){
            die("err de req");
        }
    }

    public function  updateVerificationCode($email, $code){
         
    }

    public static  function login($email,$password) {
       $db=Database::getInstance()->getConnection();
       try{
        $stmt = $db->prepare("SELECT * FROM users WHERE email =:email"); 
        $stmt->bindParam(':email', $email);
       $stmt->execute();
       $result=$stmt->fetch(PDO::FETCH_ASSOC);
        if($result){
            if (password_verify($password, $result['password'])) {

//                Session::validateSession($result);

                return $result['nexus_id']; // Connexion réussie
            }else {return false;}
        }else {return false;}

       }catch(PDOException $e){
           die('err sql');
       } 

    }

    public static function  logout(){
        Session::ActiverSession();
        unset($_SESSION['userData']);
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

    public function getNom() {
        return $this->nom;
    }

    public function getPrenom() {
        return $this->prenom;
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