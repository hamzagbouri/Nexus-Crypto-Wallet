<?php
namespace App\Model;
use App\Model\User;
use App\Model\Crypto;
use PDO;

class Transaction {
    private $id;
    private $amount;
    private $transaction_type;
    private $prix_crypto;
    private $date_transaction;
    private $user;
    private $receiver;
    private $crypto;
    private $transaction_date;

    public function __construct($id, $amount, $transaction_type, $prix_crypto, $date_transaction, $user_id = null, $receiver_id = null, $crypto_id = null, $transaction_date = null) {
        $this->id = $id;
        $this->amount = $amount;
        $this->transaction_type = $transaction_type;
        $this->prix_crypto = $prix_crypto;
        $this->date_transaction = $date_transaction;
        $this->user = User::getById($user_id) ?? null;
        $this->receiver = $receiver_id ? User::getById($receiver_id) : null;

        $this->crypto = $crypto_id;
        $this->transaction_date = $transaction_date;
    }

    public static function create($amount, $transaction_type, $prix_crypto, $user_id, $receiver_id = null, $crypto_id = null) {
        try {
            $pdo = Database::getInstance()->getConnection();
            $stmt = $pdo->prepare("
                INSERT INTO transaction (amount, transaction_type, prix_crypto, id_user, id_receiver, id_crypto,transaction_date) 
                VALUES (:amount, :transaction_type, :prix_crypto, :id_user, :id_receiver, :id_crypto, NOW())
            ");
            $stmt->bindParam(":amount", $amount, PDO::PARAM_STR);
            $stmt->bindParam(":transaction_type", $transaction_type, PDO::PARAM_STR);
            $stmt->bindParam(":prix_crypto", $prix_crypto, PDO::PARAM_STR);
            $stmt->bindParam(":id_user", $user_id, PDO::PARAM_INT);
            $stmt->bindParam(":id_receiver", $receiver_id, $receiver_id ? PDO::PARAM_STR : PDO::PARAM_NULL);
            $stmt->bindParam(":id_crypto", $crypto_id, $crypto_id ? PDO::PARAM_STR : PDO::PARAM_NULL);

            if ($stmt->execute()) {
                return new Transaction(
                    $pdo->lastInsertId(),
                    $amount,
                    $transaction_type,
                    $prix_crypto,
                    date("Y-m-d H:i:s"),
                    $user_id,
                    $receiver_id,
                    $crypto_id,
                    date("Y-m-d")
                );
            }
            return null;
        } catch (\PDOException $e) {
            error_log("Transaction creation failed: " . $e->getMessage());
            return null;
        }
    }

    public static function getUserTransaction($user_id) {
        $pdo = Database::getInstance()->getConnection();
        $stmt = $pdo->prepare('SELECT * FROM transaction WHERE id_user = :user_id');
        $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $transactions = [];

        foreach ($result as $row) {
            $transactions[] = new Transaction(
                $row['id_trans'],
                $row['amount'],
                $row['transaction_type'],
                $row['prix_crypto'],
                $row['date_transaction'],
                $row['id_user'],
                $row['id_receiver'],
                $row['id_crypto'],
                $row['transaction_date']
            );
        }
        return $transactions;
    }

    // Getters
    public function getId() { return $this->id; }
    public function getAmount() { return $this->amount; }
    public function getTransactionType() { return $this->transaction_type; }
    public function getPrixCrypto() { return $this->prix_crypto; }
    public function getDateTransaction() { return $this->date_transaction; }
    public function getUser() { return $this->user; }
    public function getReceiver() { return $this->receiver; }
    public function getCrypto() { return $this->crypto; }
    public function getTransactionDate() { return $this->transaction_date; }
}
?>
