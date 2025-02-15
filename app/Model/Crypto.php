<?php

namespace App\Model;
use App\Model\User;
use App\Model\Wallet;
use PDOException;
use PDO;
use App\Model\Database;
use Exception;

class Crypto {
    private $user;
    private $wallet;
    private $mail;

    public function __construct() {
        Session::ActiverSession();

        $this->user = unserialize($_SESSION['userData']);
        $this->wallet = unserialize($_SESSION['wallet']);
        $this->mail = new Mail();

    }

    public function buy($id_crypto, $amount, $price) {
        $pdo = Database::getInstance()->getConnection();
        $wallet_id = $this->wallet->getId();
        $totalCost = $amount * $price;

        // Check if the user has enough USDT balance
        if ($this->user->getUsdtBalance() < $totalCost) {
            throw new Exception("Insufficient USDT balance to complete the purchase.");
        }
        echo "total Cost ".$totalCost;

        // Check if crypto exists in the wallet
        if ($this->checkCrypto($id_crypto, $wallet_id)) {
            // Update existing crypto amount
            $stmt = $pdo->prepare("UPDATE wallet_crypto SET amount = amount + :amount WHERE id_wallet = :id_wallet AND id_crypto = :id_crypto");
        } else {
            // Insert new row for new crypto
            $stmt = $pdo->prepare("INSERT INTO wallet_crypto (id_wallet, id_crypto, amount) VALUES (:id_wallet, :id_crypto, :amount)");
        }
        $stmt->bindParam(':id_wallet', $wallet_id);
        $stmt->bindParam(':id_crypto', $id_crypto);
        $stmt->bindParam(':amount', $amount);
        $stmt->execute();
        $this->wallet = Wallet::getWalletForUser($this->user->getId());
        Transaction::create($amount, "Buy", $price, $this->user->getId(), null, $id_crypto);

        $this->updateUserBalance($this->user->getUsdtBalance() - $totalCost);
        $email = $this->user->getEmail();
        $subject = "Achat de cryptomonnaie confirme";
        $body = "Bonjour " . $this->user->getNom() . ",\n\n";
        $body .= "Votre achat de " . $amount . " unites de la cryptomonnaie " . $id_crypto . " a ete effectue avec succes.\n";
        $body .= "Montant total dépense : " . $totalCost . " USDT.\n\n";
        $body .= "Merci d'utiliser notre plateforme.";

        $this->mail->sendNotification($email, $body, $subject);
    }

    public function sell($id_crypto, $amount, $price) {
        $pdo = Database::getInstance()->getConnection();
        $wallet_id = Wallet::getWalletId($this->user->getId());
        // Check if user has the crypto
        $currentAmount = $this->getCryptoAmount($id_crypto, $wallet_id);
        if ($currentAmount < $amount) {
            throw new \Exception("Insufficient balance to sell");
        }

        // Update or remove if amount is zero
        if ($currentAmount == $amount) {
            $stmt = $pdo->prepare("DELETE FROM wallet_crypto WHERE id_wallet = :id_wallet AND id_crypto = :id_crypto");
            $stmt->bindParam(':id_wallet', $wallet_id, PDO::PARAM_INT);
            $stmt->bindParam(':id_crypto', $id_crypto, PDO::PARAM_STR);
        } else {
            $stmt = $pdo->prepare("UPDATE wallet_crypto SET amount = amount - :amount WHERE id_wallet = :id_wallet AND id_crypto = :id_crypto");
            $stmt->bindParam(':id_wallet', $wallet_id, PDO::PARAM_INT);
            $stmt->bindParam(':id_crypto', $id_crypto, PDO::PARAM_STR);
            $stmt->bindParam(':amount', $amount, PDO::PARAM_STR);
        }

        // Bind parameters

        $stmt->execute();

        Transaction::create($amount, "Sell", $price, $this->user->getId(), null, $id_crypto);
        // Update user balance
        $totalGain = $amount * $price;
        $this->updateUserBalance($this->user->getUsdtBalance() + $totalGain);
        $email = $this->user->getEmail();
        $subject = "Vente de cryptomonnaie confirmee";
        $body = "Bonjour " . $this->user->getNom() . ",\n\n";
        $body .= "Vous avez vendu " . $amount . " unités de la cryptomonnaie " . $id_crypto . " avec succes.\n";
        $body .= "Montant total reçu : " . $totalGain . " USDT.\n\n";
        $body .= "Merci d'utiliser notre plateforme.";

        $this->mail->sendNotification($email, $body, $subject);
        return 'DOne';

    }

    private function checkCrypto($id_crypto, $wallet_id) {
        $pdo = Database::getInstance()->getConnection();
        $stmt = $pdo->prepare("SELECT COUNT(*) as count FROM wallet_crypto WHERE id_crypto = :id_crypto AND id_wallet = :id_wallet");
        $stmt->bindParam(':id_crypto', $id_crypto);
        $stmt->bindParam(':id_wallet', $wallet_id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)['count'] > 0;
    }

    private function getCryptoAmount($id_crypto, $wallet_id) {
        $pdo = Database::getInstance()->getConnection();
        $stmt = $pdo->prepare("SELECT amount FROM wallet_crypto WHERE id_crypto = :id_crypto AND id_wallet = :id_wallet");
        $stmt->bindParam(':id_crypto', $id_crypto);
        $stmt->bindParam(':id_wallet', $wallet_id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)['amount'] ?? 0;
    }

    private function updateUserBalance($newBalance) {
        Session::ActiverSession();
        $pdo = Database::getInstance()->getConnection();
        $idUser = $this->user->getId();
        $stmt = $pdo->prepare("UPDATE users SET usdt_balance = :balance WHERE id_user = :id");
        $stmt->bindParam(':balance', $newBalance);
        $stmt->bindParam(':id', $idUser );
        $stmt->execute();
        $this->user->setUsdtBalance($newBalance);
    }
    public function send($receiver, $crypto, $amount)
    {
        $pdo = Database::getInstance()->getConnection();
        $wallet_id = $this->wallet->getId();
        $receiverUser = User::getUserByEmail($receiver);

        if ($crypto === 'usdt') {
            // Handle USDT transfer by updating user balances directly

            if (!$receiverUser) {
                throw new Exception("Receiver not found.");
            }

            if ($this->user->getUsdtBalance() < $amount) {
                throw new Exception("Insufficient USDT balance.");
            }

            // Deduct from sender
            $this->updateUserBalance($this->user->getUsdtBalance() - $amount);

            // Add to receiver
            $receiverUser->setUsdtBalance($receiverUser->getUsdtBalance() + $amount,true);
            $recei = $receiverUser->getUsdtBalance();
            $receiverId = $receiverUser->getId();
            $stmt = $pdo->prepare("UPDATE users SET usdt_balance = :balance WHERE id_user = :id");
            $stmt->bindParam(':balance', $recei);
            $stmt->bindParam(':id', $receiverId);
            $stmt->execute();
            var_dump("Creating transaction", $amount, "Send", null, $this->user->getId(), $receiver, $crypto);
            Transaction::create($amount, "Send", null, $this->user->getId(), $receiverUser->getId(), $crypto);
            $this->sendTransferNotification($this->user, $receiverUser, $crypto, $amount);

            return "USDT transfer successful.";
        }
        $wal = Wallet::getWalletForUser($receiverUser->getId());
        $this->wallet = Wallet::getWalletForUser($this->user->getId());
        // Handle other cryptocurrencies
        $receiver_wallet_id = Wallet::getWalletForSend($receiver);
        if (!$receiver_wallet_id) {
            throw new Exception("Receiver does not have a wallet.");
        }

        // Check sender's crypto balance
        $currentAmount = $this->getCryptoAmount($crypto, $wallet_id);
        if ($currentAmount < $amount) {
            throw new Exception("Insufficient balance to send.");
        }

        // Deduct from sender
        if ($currentAmount == $amount) {
            $stmt = $pdo->prepare("DELETE FROM wallet_crypto WHERE id_wallet = :id_wallet AND id_crypto = :id_crypto");
        } else {
            $stmt = $pdo->prepare("UPDATE wallet_crypto SET amount = amount - :amount WHERE id_wallet = :id_wallet AND id_crypto = :id_crypto");
        }
        $stmt->bindParam(':id_wallet', $wallet_id, PDO::PARAM_INT);
        $stmt->bindParam(':id_crypto', $crypto, PDO::PARAM_STR);
        $stmt->bindParam(':amount', $amount, PDO::PARAM_STR);
        $stmt->execute();

        // Add to receiver
        if ($this->checkCrypto($crypto, $receiver_wallet_id)) {
            $stmt = $pdo->prepare("UPDATE wallet_crypto SET amount = amount + :amount WHERE id_wallet = :id_wallet AND id_crypto = :id_crypto");
        } else {
            $stmt = $pdo->prepare("INSERT INTO wallet_crypto (id_wallet, id_crypto, amount) VALUES (:id_wallet, :id_crypto, :amount)");
        }
        $stmt->bindParam(':id_wallet', $receiver_wallet_id, PDO::PARAM_INT);
        $stmt->bindParam(':id_crypto', $crypto, PDO::PARAM_STR);
        $stmt->bindParam(':amount', $amount, PDO::PARAM_STR);
        $stmt->execute();
        var_dump("Creating transaction", $amount, "Send", null, $this->user->getId(), $receiver, $crypto);
        Transaction::create($amount, "Send", null, $this->user->getId(), $receiverUser->getId(), $crypto);
        $this->sendTransferNotification($this->user, $receiverUser, $crypto, $amount);
        return "Crypto transfer successful.";
    }
    private function sendTransferNotification($sender, $receiver, $crypto, $amount)
    {
        // Email de l'expéditeur
        $senderEmail = $sender->getEmail();
        $receiverEmail = $receiver->getEmail();

        // Sujet et message pour l'expéditeur
        $subjectSender = "Confirmation de votre transfert de $crypto";
        $bodySender = "Bonjour " . $sender->getNom() . ",\n\n";
        $bodySender .= "Vous avez envoyé " . $amount . " unités de " . strtoupper($crypto) . " à " . $receiver->getNom() . " avec succès.\n\n";
        $bodySender .= "Merci d'utiliser notre plateforme.";

        // Sujet et message pour le destinataire
        $subjectReceiver = "Vous avez reçu un transfert de $crypto";
        $bodyReceiver = "Bonjour " . $receiver->getNom() . ",\n\n";
        $bodyReceiver .= "Vous avez reçu " . $amount . " unités de " . strtoupper($crypto) . " de la part de " . $sender->getNom() . ".\n\n";
        $bodyReceiver .= "Merci d'utiliser notre plateforme.";

        // Envoi des emails
        $this->mail->sendNotification($senderEmail, $bodySender, $subjectSender);
        $this->mail->sendNotification($receiverEmail, $bodyReceiver, $subjectReceiver);
    }


}
