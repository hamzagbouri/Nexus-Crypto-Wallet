<?php
namespace App\Model;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use App\Model\Session;


class Mail {
    private $config;

    public function __construct() {
        $this->config = require __DIR__ . '/../Config//ConfigMail.php';
     
    }

    public function sendVerificationCode($email, $code) {
        $mail = new PHPMailer(true);

        try {
            // Configuration SMTP
            $mail->isSMTP();
            $mail->Host       = $this->config['smtp_host'];
            $mail->SMTPAuth   = true;
            $mail->Username   = $this->config['smtp_user'];
            $mail->Password   = $this->config['smtp_pass'];
            $mail->SMTPSecure = $this->config['smtp_secure'];
            $mail->Port       = $this->config['smtp_port'];

            // Paramètres de l'email
            $mail->setFrom($this->config['from_email'], $this->config['from_name']);
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = "Code de vérification";
            $mail->Body    = "Votre code de vérification est : <b>$code</b>";
            session::ActiverSession();
            $_SESSION['code']=$code;

            $mail->send();
            return true;
        } catch (Exception $e) {
            return "Erreur lors de l'envoi du mail : {$mail->ErrorInfo}";
        }
    }
}
