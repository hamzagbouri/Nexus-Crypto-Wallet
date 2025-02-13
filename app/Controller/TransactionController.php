<?php
namespace App\Controller;
use App\Model\Transaction;
use App\Model\Session;
use PDOException;
use PDO;

class TransactionController {
    private $transactionModel;
    private $userId;

    public function __construct() {
        $this->transactionModel = new Transaction();
        Session::ActiverSession();
        $user = unserialize($_SESSION['userData']);
        $this->userId = $user->getId();
    }

    public function buyCrypto() {
        unset($_SESSION['transaction']);
        
        $userId = $this->userId;
        $cryptoName = $_POST['cryptoName'];
        $cryptoPrice = floatval($_POST['price']);
        $action = $_POST['action'];
        $amount = floatval($_POST['amount']);
        $costInUsdt = $amount * $cryptoPrice;
        if ($amount <= 0) {
            $_SESSION['transaction']['error'] = "Amount must be greater than 0";
            header('Location: /nexus-crypto-wallet/home/watchlist');
            exit;
        }

        $currentBalance = $this->transactionModel->getUserBalance($userId);

        if ($action === 'Buy') {
            if ($currentBalance < $costInUsdt) {
                $_SESSION['transaction']['error'] = "Insufficient balance. You need: $costInUsdt USDT, Available: $currentBalance USDT";
                header('Location: /nexus-crypto-wallet/home/watchlist');
                exit;
            }

            try {
                $transactionId = $this->transactionModel->createTransaction(
                    $userId, 
                    $cryptoName, 
                    $amount,
                    'buy',
                    'completed',
                    $cryptoPrice
                );

                $this->transactionModel->updateUserBalance($userId, -$costInUsdt);
                $walletId = $this->transactionModel->getWalletIdByUser($userId);
                $this->transactionModel->updateOrInsertWalletCrypto($walletId, $cryptoName, $amount);

                $_SESSION['transaction']['success'] = "Successfully bought $amount $cryptoName for $costInUsdt USDT";
            } catch (PDOException $e) {
                $_SESSION['transaction']['error'] = "Failed to buy: " . $e->getMessage();
            }
        }
        elseif ($action === 'Sell') {
            try {
                $walletId = $this->transactionModel->getWalletIdByUser($userId);
                $cryptoBalance = $this->transactionModel->getCryptoBalance($userId, $cryptoName);

                if ($cryptoBalance < $amount) {
                    $_SESSION['transaction']['error'] = "Insufficient crypto balance. You have: $cryptoBalance $cryptoName";
                    header('Location: /nexus-crypto-wallet/home/watchlist');
                    exit;
                }

                $transactionId = $this->transactionModel->createTransaction(
                    $userId, 
                    $cryptoName, 
                    $amount,
                    'sell',
                    'completed',
                    $cryptoPrice
                );

                $this->transactionModel->updateUserBalance($userId, $costInUsdt);
                $this->transactionModel->updateOrInsertWalletCrypto($walletId, $cryptoName, -$amount);

                $_SESSION['transaction']['success'] = "Successfully sold $amount $cryptoName for $costInUsdt USDT";
            } catch (PDOException $e) {
                $_SESSION['transaction']['error'] = "Failed to sell: " . $e->getMessage();
            }
        }

        header('Location: /nexus-crypto-wallet/home/watchlist');
        exit;
    }
}