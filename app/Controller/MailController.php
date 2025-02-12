<?php
namespace App\Controller;

use App\core\Controller;
use App\Model\User;
use App\Model\Mail;

class MailController {
    public function sendCode() {


        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = $_POST['email'];

         
            $user = user::getUserByEmail($email);

            if ($user) {
                $code = rand(100000, 999999); // Génération d’un code aléatoire
              
                // $userModel->updateVerificationCode($email, $code);
                $mailModel = new Mail();
                $result = $mailModel->sendVerificationCode($email, $code);

                if ($result === true) {
                    echo "Code envoyé avec succès !";
                    header("Location: /verify_code");
                    exit();
                } else {
                    echo "Erreur : " . $result;
                }
            } else {
                echo "Email non trouvé.";
            }
        }
    }

    // public function verifyCode() {
    //     if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //         $code = $_POST['code'];
    //         $email = $_SESSION['email']; 
    
    //         $userModel = new User();
    //         if ($userModel->checkVerificationCode($email, $code)) {
    //             echo "Authentification réussie !";
    //             header("Location: /dashboard");
    //             exit();
    //         } else {
    //             echo "Code invalide.";
    //         }
    //     }
    // }
    
}
