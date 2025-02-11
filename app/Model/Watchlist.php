<?php
namespace App\Model;
use App\Model\Database;
use App\Model\User;
use PDO;

class Watchlist {
    private $id;
    private $user;
    private $cryptos;
    
    public function __construct($id,  $user, $cryptos) {
        $this->id = $id;
        $this->user = $user;
        $this->cryptos = $cryptos;
    }


    public static function add($user, $crypto) {
        $pdo = Database::getInstance()->getConnection();
        $stmt = $pdo->prepare('INSERT INTO "watchlist" (id_user, id_crypto) VALUES (:user_id, :crypto_id)');
        $stmt->bindParam(":user_id", $user, PDO::PARAM_INT);
        $stmt->bindParam(":crypto_id", $crypto, PDO::PARAM_STR);
        $stmt->execute();
        return "done";
    }

    public function removeCrypto($crypto) {
        // Implementation
    }

    public function getId() {
        return $this->id;
    }
    public function getCryptos() {
        return $this->cryptos;
    }
    public function getUser(): User {
        return $this->user;
    }
    public static function getAll($user)
    {
        $pdo = Database::getInstance()->getConnection();
        $stmt = $pdo->prepare('SELECT * FROM "watchlist" WHERE id_user = :user_id');
        $stmt->bindParam(":user_id", $user, PDO::PARAM_INT);
        $stmt->execute();
        $result =  $stmt->fetchAll(PDO::FETCH_ASSOC);
        $cryptos = [];
        $watchlist = [];
        foreach($result as $row)
        {
            $cryptos[] = $row['id_crypto'];
            $watchlist = new Watchlist($row['id_watchlist'], $row['id_user'], $cryptos);
        }
        return $watchlist;
    }
    public static function supprimer($slug)
    {
        $pdo = Database::getInstance()->getConnection();
        $stmt = $pdo->prepare('DELETE FROM "watchlist" WHERE id_crypto = :slug');
        $stmt->bindParam(":slug", $slug, PDO::PARAM_STR);
        $stmt->execute();
    }
    public static function checkCrypto($slug,$user){
        $pdo = Database::getInstance()->getConnection();
        $stmt = $pdo->prepare('SELECT count(*) as total FROM "watchlist" WHERE id_crypto = :slug and id_user = :user_id');
        $stmt->bindParam(":slug", $slug, PDO::PARAM_STR);
        $stmt->bindParam(":user_id", $user, PDO::PARAM_INT);
        $stmt->execute();
        $result =  $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'] == 1 ? true : false;
    }
}
?>