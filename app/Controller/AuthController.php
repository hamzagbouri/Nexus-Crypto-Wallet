<?php
namespace App\Controller;

use App\core\Controller;
use App\Model\User;
use App\Model\Session;
use App\Model\Mail;
use App\Model\Wallet;

class AuthController extends Controller{
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = trim(htmlspecialchars($_POST['username']));
            $password = trim(htmlspecialchars($_POST['password']));
            $user = User::login($email, $password);
             if($user){
                $code= str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT);
                $Mail= new Mail();
                $Mail->sendVerificationCode($email,$code);
               header("location: /Nexus-crypto-wallet/Home/verify/$user");
             }else{
                session::ActiverSession();
                $_SESSION['error']="mot de pass ou mail invalide";
                header('location: /Nexus-crypto-wallet/Home/login');
                // echo "mot de pass ou mail invalide";
             }
           
  
            
            exit;
        }
      }
      public function signup() {
          if($_SERVER['REQUEST_METHOD'] == 'POST') {
              print_r($_POST);
             
              $firstName = trim(htmlspecialchars($_POST['firstName']));
              $lastName=trim(htmlspecialchars($_POST['lastName']));
              $birthdate=trim(htmlspecialchars($_POST['birthdate']));
              $email = trim(htmlspecialchars($_POST['email']));
              $password = trim(htmlspecialchars($_POST['password']));
              $usdt_balance = trim(htmlspecialchars($_POST['usdt_balance']));
              user::registre($firstName,$lastName,$birthdate,$email,$password,$usdt_balance);
              session::ActiverSession();
              $_SESSION['success']="Registre with success";
              header('location: /Nexus-crypto-wallet/Home/login');           
              exit;
          }
  
      }

      public function verify_code($user){
          session::ActiverSession();
        if($_SERVER['REQUEST_METHOD']=='POST'){
            $code=$_POST['code'];

             if($code == $_SESSION['code']){
                 $userObjet = User::getById($user);
                Session::validateSession($userObjet);
                 $w = Wallet::getWalletForUser($userObjet->getId());
                 $_SESSION['wallet'] = serialize($w);
               unset($_SESSION['code']);
                header('location: /Nexus-crypto-wallet/Home/watchList');
                exit;
             }else{
                 $_SESSION['error']="Invalid Code";
                 header('location: /Nexus-crypto-wallet/Home/verify');

             }
        }

      }
      
      public function logout() {
          User::logout();
          header('Location: /nexus-crypto-wallet/home/login');
      }
}