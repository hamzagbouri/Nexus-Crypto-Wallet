<?php
require_once 'User.php';
class Notification {
    private $id;
    private $message;
    private $date;
    private User $user; 

    public function __construct($id, $message, $date, User $user) {
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

    public function getUser(): User {
        return $this->user;
    }
}
?>