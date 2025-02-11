<?php
namespace App\Model;
use App\Model\User;
class Notification {
    private $id;
    private $message;
    private $date;
    private $user;

    public function __construct($id, $message, $date, $user = null) {
        $this->id = $id;
        $this->message = $message;
        $this->date = $date;
        $this->user = $user;
    }

    public function sendNotification() {
        // Implementation
    }

    public function getId() {
        return $this->id;
    }

    public function getMessage() {
        return $this->message;
    }

    public function getDate() {
        return $this->date;
    }

    public function getUser() {
        return $this->user;
    }
}
?>