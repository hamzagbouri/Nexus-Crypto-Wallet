<?php
class Notification {
    private $id;
    private $user;
    private $message;
    private $read;

    public function __construct($id, $user, $message, $read = false) {
        $this->id = $id;
        $this->user = $user;
        $this->message = $message;
        $this->read = $read;
    }

    // Getter and Setter for id
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    // Getter and Setter for user
    public function getUser() {
        return $this->user;
    }

    public function setUser($user) {
        $this->user = $user;
    }

    // Getter and Setter for message
    public function getMessage() {
        return $this->message;
    }

    public function setMessage($message) {
        $this->message = $message;
    }

    // Getter and Setter for read
    public function isRead() {
        return $this->read;
    }

    public function setRead($read) {
        $this->read = $read;
    }

    // Mark notification as read
    public function markAsRead() {
        $this->read = true;
    }
}
?>