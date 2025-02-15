<?php
namespace App\Model;

use PDO;

class Wallet {
    private $id;
    private $balances; // Array of crypto balances
    private $user;

    public function __construct($id, User $user, array $balances = []) {
        $this->id = $id;
        $this->user = $user;
        $this->balances = $balances; // Format: ['BTC' => 0.5, 'ETH' => 2.0]
    }
    public static function getWallet($id_user) {
        $wallet = new Wallet($id_user);
    }

    public function getBalance($cryptoSymbol) {
        return $this->balances[$cryptoSymbol] ?? 0; // Return 0 if crypto not found
    }

    public function addFunds($cryptoSymbol, $amount) {
        if (!isset($this->balances[$cryptoSymbol])) {
            $this->balances[$cryptoSymbol] = 0; // Initialize if not present
        }
        $this->balances[$cryptoSymbol] += $amount;
    }

    public function withdrawFunds($cryptoSymbol, $amount) {
        if (!isset($this->balances[$cryptoSymbol]) || $this->balances[$cryptoSymbol] < $amount) {
            throw new \Exception("Insufficient balance for $cryptoSymbol");
        }
        $this->balances[$cryptoSymbol] -= $amount;
    }

    public function transferFunds($cryptoSymbol, $amount, Wallet $receiver) {
        $this->withdrawFunds($cryptoSymbol, $amount); // Deduct from sender
        $receiver->addFunds($cryptoSymbol, $amount); // Add to receiver
    }

    public function getId() {
        return $this->id;
    }

    public function getUser() {
        return $this->user;
    }

    public function getAllBalances() {
        return $this->balances;
    }
    public static function getWalletForUser($id_user) {
        $pdo = Database::getInstance()->getConnection();
        $stmt = $pdo->prepare("
        SELECT wc.* FROM wallet_crypto wc
        INNER JOIN wallet w ON w.id_wallet = wc.id_wallet
        INNER JOIN users u ON u.id_user = w.id_user
        WHERE u.id_user = :id_user
    ");
        $stmt->bindParam(":id_user", $id_user);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $u = User::getById($id_user);
        if (!$rows)
        {
           $wal =  self::getWalletId($id_user);
           return new Wallet($wal, $u,[]);
        } else {
            $cryptos = [];
            foreach ($rows as $row) {
                $cryptos[$row['id_crypto']] = $row['amount'];
            }

            $wallet = new Wallet($rows[0]['id_wallet'], $u, $cryptos);
        };

        Session::ActiverSession();
        if(isset($_SESSION['wallet'])){
            unset($_SESSION['wallet']);

        }
        $_SESSION['wallet'] = serialize($wallet);
        return $wallet;
    }
    public static function create($userId)
    {
        $pdo = Database::getInstance()->getConnection();
        $stmt = $pdo->prepare("Insert into wallet( id_user) values( :user)");
        $stmt->bindParam(":user", $userId);
        $stmt->execute();
    }
    public static function getWalletId($userId)
    {
        $pdo = Database::getInstance()->getConnection();
        $stmt = $pdo->prepare("Select id_wallet from wallet where id_user = :user");
        $stmt->bindParam(":user", $userId);
        $stmt->execute();
        $rows = $stmt->fetch(PDO::FETCH_ASSOC);
        return $rows['id_wallet'];

    }
    public static function getWalletForSend($idUser)
    {
        $pdo = Database::getInstance()->getConnection();

        // First, get the user ID
        $stmt = $pdo->prepare("SELECT id_user FROM users WHERE nexus_id = :idUser OR email = :idUser");
        $stmt->bindParam(":idUser", $idUser);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            return null; // User not found
        }

        // Now, get the wallet ID using the found user ID
        $stmt = $pdo->prepare("SELECT id_wallet FROM wallet WHERE id_user = :userId");
        $stmt->bindParam(":userId", $user['id_user']);
        $stmt->execute();
        $wallet = $stmt->fetch(PDO::FETCH_ASSOC);

        return $wallet ? $wallet['id_wallet'] : null;
    }




}
?>
