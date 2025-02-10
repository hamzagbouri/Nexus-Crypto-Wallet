<?php
class Transaction {
    private $id;
    private $sender;
    private $receiver;
    private $crypto;
    private $amount;
    private $transaction_type;
    private $status;
    private $date;

    public function __construct($id, $sender, $receiver, $crypto, $amount, $transaction_type, $status, $date) {
        $this->id = $id;
        $this->sender = $sender;
        $this->receiver = $receiver;
        $this->crypto = $crypto;
        $this->amount = $amount;
        $this->transaction_type = $transaction_type;
        $this->status = $status;
        $this->date = $date;
    }

    // Getter and Setter for id
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    // Getter and Setter for sender
    public function getSender() {
        return $this->sender;
    }

    public function setSender($sender) {
        $this->sender = $sender;
    }

    // Getter and Setter for receiver
    public function getReceiver() {
        return $this->receiver;
    }

    public function setReceiver($receiver) {
        $this->receiver = $receiver;
    }

    // Getter and Setter for crypto
    public function getCrypto() {
        return $this->crypto;
    }

    public function setCrypto($crypto) {
        $this->crypto = $crypto;
    }

    // Getter and Setter for amount
    public function getAmount() {
        return $this->amount;
    }

    public function setAmount($amount) {
        $this->amount = $amount;
    }

    // Getter and Setter for transaction_type
    public function getTransactionType() {
        return $this->transaction_type;
    }

    public function setTransactionType($transaction_type) {
        $this->transaction_type = $transaction_type;
    }

    // Getter and Setter for status
    public function getStatus() {
        return $this->status;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

    // Getter and Setter for date
    public function getDate() {
        return $this->date;
    }

    public function setDate($date) {
        $this->date = $date;
    }
}
?>