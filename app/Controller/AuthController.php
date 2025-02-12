<?php
namespace App\Controller;

use App\core\Controller;
use App\Model\User;
use App\Model\Session;
use App\Model\Mail;

class AuthController extends Controller{
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = trim(htmlspecialchars($_POST['username']));
            $password = trim(htmlspecialchars($_POST['password']));
             if(user::login($email,$password)){
                $code= str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT);
                $Mail= new Mail();
                $Mail->sendVerificationCode($email,$code);
               header('location: /Nexus-crypto-wallet/Home/verify');
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

      public function verify_code(){
        if($_SERVER['REQUEST_METHOD']=='POST'){
            $code=$_POST['code'];
            session::ActiverSession();
             if($code == $_SESSION['code']){
               
                header('location: /Nexus-crypto-wallet/Home/watchList');
                exit;
             }else{
                echo "code invalide";
             }
        }
      }
      
      public function logout() {
          User::logout();
          header('Location: /Youdemy-mvc/home/login');
      }
}