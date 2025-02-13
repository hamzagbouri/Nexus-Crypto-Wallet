<?php 
namespace App\Controller;
use App\Model\Transaction;
use App\Model\Session;
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

    private function checkUserBalance($userId, $costInUsdt) {
        $userBalance = $this->transactionModel->getUserBalance($userId);
        if ($userBalance < $costInUsdt) {
            return [
                'success' => false, 
                'message' => 'Insufficient balance'
            ];
        }
        return ['success' => true];
    }

    private function calculateTotalCost($amount, $cryptoPrice) {
        return $amount * $cryptoPrice;
    }

    public function buyCrypto() {
        $userId = $this->userId;
        $cryptoName = $_POST['cryptoName'];  
        $cryptoPrice = floatval($_POST['price']);
        $action = $_POST['action'];
        $status = 'completed';
        $amount = $_POST['amount'];
    
        // Debugging with var_dump
        var_dump($userId, $cryptoName, $cryptoPrice, $action, $status, $amount);
    
        if (!$cryptoPrice || $cryptoPrice <= 0) {
            echo "Invalid crypto price\n";
            return;
        }
    
        $costInUsdt = $this->calculateTotalCost($amount, $cryptoPrice);
        $balanceCheck = $this->checkUserBalance($userId, $costInUsdt);
    
        if (!$balanceCheck['success']) {
            echo "Balance check failed: " . $balanceCheck['message'] . "\n";
            return;
        }
    
        try {
            if ($action === 'Buy') {
                $transactionId = $this->transactionModel->createTransaction(
                    $userId, 
                    $cryptoName, 
                    $amount, 
                    'buy', 
                    'completed', 
                    $cryptoPrice
                );
                
                echo "Transaction ID: " . $transactionId . "\n";  
    
                if ($transactionId) {
                    echo "Transaction successfully created\n";
                    $this->transactionModel->updateUserBalance($userId, -$costInUsdt, 'buy');
                    echo "User balance updated\n";
                    $walletId = $this->transactionModel->getWalletIdByUser($userId);
                    var_dump($walletId);
                    if (!$walletId) {
                        echo "Wallet not found\n";
                        return;
                    }
    
                    $this->transactionModel->updateWalletCryptos($walletId, $cryptoName, $amount);
                    echo "Wallet updated with crypto\n";
    
                } else {
                    echo "Transaction failed to complete\n";
                }
            }
    
            elseif ($action === 'sell') {
                echo "Handle sell action\n";
    
                $cryptoId = $this->transactionModel->getCryptoIdByName($cryptoName);
                var_dump($cryptoId);
    
                if (!$cryptoId) {
                    echo "Crypto not found\n";
                    return;
                }
    
                $walletId = $this->transactionModel->getWalletIdByUser($userId);
                $cryptoBalance = $this->transactionModel->getCryptoBalance($walletId, $cryptoId);
                echo "Crypto balance: " . $cryptoBalance . "\n";
    
                if ($cryptoBalance < $amount) {
                    echo "Insufficient crypto balance\n";
                    return;
                }
    
                $transactionId = $this->transactionModel->createTransaction(
                    $userId, 
                    $cryptoId, 
                    $amount, 
                    'sell', 
                    $status, 
                    $cryptoPrice
                );
                var_dump($transactionId);
    
                $this->transactionModel->updateUserBalance($userId, $costInUsdt, 'sell');
                echo "User balance updated after sell\n";
    
                $this->transactionModel->updateWalletCryptos($walletId, $cryptoId, -$amount);
                echo "Wallet updated after sell\n";
            }
    
        } catch (Exception $e) {
            // Catch any exception and display the error message
            echo "Error: " . $e->getMessage() . "\n";
        }
    }
    
}
