<?php 
    namespace App\Controller;
    use App\Model\Transaction;
    use App\Model\User;
    use App\Model\Session;

    use App\Model\Crypto;
    use PDO;
    
    class TransactionController {
        private $transactionModel;
    
        public function __construct() {
            $this->transactionModel = new Transaction();
            Session::ActiverSession();  // Ensure session is active
            if (!isset($_SESSION['userData'])) {
                echo json_encode(['status' => 'failed', 'message' => 'User is not logged in']);
                header('Location: /nexus-crypto-wallet/home/login');
                exit;
            }
        }
            private function checkUserBalance($userId, $costInUsdt) {
            $userBalance = $this->transactionModel->getUserBalance($userId);
            if ($userBalance < $costInUsdt) {
                return ['success' => false, 'message' => 'Insufficient balance'];
            }
            return ['success' => true];
        }
            private function calculateTotalCost($amount, $cryptoPrice) {
            return $amount * $cryptoPrice;
        }
    


        public function buyCrypto() {

            error_log("buyCrypto() function called"); 
            error_log(print_r($_POST, true));
            error_log(file_get_contents('php://input'));
        
            $data = json_decode(file_get_contents("php://input"), true);
            error_log(print_r($data, true));
        
            if (!$data) {
                echo json_encode(['status' => 'failed', 'message' => 'No data received']);
                return;
            }
            $data = json_decode(file_get_contents("php://input"), true);

            $amount = $data['amount'];
            $userId = $_SESSION['Datauser']['id'];
            $cryptoId = $data['cryptoId'];
            $cryptoPrice = $data['price'];
            $action = $data['action'];
            $status = $data['status'];
            $usdtAmount = $data['usdtAmount'];
            $type = $data['transactionType'];
            
        
            if (!$cryptoPrice) {
                echo json_encode(['status' => 'failed', 'message' => 'Invalid crypto price']);
                return;
            }
        
            $costInUsdt = $this->calculateTotalCost($amount, $cryptoPrice);
            $balanceCheck = $this->checkUserBalance($userId, $costInUsdt);
        
            if (!$balanceCheck['success']) {
                echo json_encode(['status' => 'failed', 'message' => $balanceCheck['message']]);
                return;
            }
        
            $transactionId = $this->transactionModel->createTransaction(
                $userId, $cryptoId, $amount, null, 'buy', $status, $cryptoPrice
            );
        
            echo json_encode(['status' => 'success', 'message' => 'Transaction Successful!']);
        }
        
    
        public function sellCrypto($userId, $cryptoId, $amount, $cryptoPrice) {
            if (!$cryptoPrice) {
                return ['success' => false, 'message' => 'Invalid crypto price'];
            }
        
            $walletId = $this->transactionModel->getWalletIdByUser($userId);
            $cryptoBalance = $this->transactionModel->getCryptoBalance($walletId, $cryptoId);
            
            if ($cryptoBalance < $amount) {
                return ['success' => false, 'message' => 'Not enough cryptocurrency in the wallet to sell'];
            }
        
            $amountInUsdt = $this->calculateTotalCost($amount, $cryptoPrice);
                $transactionId = $this->transactionModel->createTransaction(
                $userId, $cryptoId, $amount, null, 'sell', 'pending', $cryptoPrice
            );
        
            $this->transactionModel->updateUserBalance($userId, $amountInUsdt,'sell'); 
            $this->transactionModel->updateWalletCryptos($walletId, $cryptoId, -$amount); 
            $this->transactionModel->updateTransactionStatus($transactionId, 'completed');
        
            return ['success' => true, 'transaction_id' => $transactionId];
        }
        
    }
    

