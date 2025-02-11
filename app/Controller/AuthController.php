<?php
namespace App\Controller;

use App\core\Controller;
use App\Model\User;

class AuthController extends Controller{
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = trim(htmlspecialchars($_POST['username']));
            $password = trim(htmlspecialchars($_POST['password']));
  
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $_SESSION['message'] = "Invalid email format";
                $_SESSION['message_type'] = "error";
                header('Location: /Youdemy-mvc/admin/login');
                exit;
            }
  
            $user = User::login($email, $password);
  
            if($user === 403)
            {
                $_SESSION['message'] = "Invalid email or password ";
                $_SESSION['message_type'] = "error";
                header('Location: /Youdemy-mvc/home/login');
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
            
              exit;
          }
  
      }
      public function logout() {
          User::logout();
          header('Location: /Youdemy-mvc/home/login');
      }
}