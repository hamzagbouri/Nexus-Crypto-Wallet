<?php
class Transaction {
    private int $id;
    private User $sender;
    private User $receiver;
    private Crypto $crypto;
    private float $amount;
    private string $transaction_type;
    private string $status;
    private string $date;

    public function __construct(int $id, User $sender, User $receiver, Crypto $crypto, float $amount, string $transaction_type, string $status, string $date) {
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
    public function getId(): int {
        return $this->id;
    }

    public function setId(int $id): void {
        $this->id = $id;
    }

    // Getter and Setter for sender
    public function getSender(): User {
        return $this->sender;
    }

    public function setSender(User $sender): void {
        $this->sender = $sender;
    }

    // Getter and Setter for receiver
    public function getReceiver(): User {
        return $this->receiver;
    }

    public function setReceiver(User $receiver): void {
        $this->receiver = $receiver;
    }

    // Getter and Setter for crypto
    public function getCrypto(): Crypto {
        return $this->crypto;
    }

    public function setCrypto(Crypto $crypto): void {
        $this->crypto = $crypto;
    }

    // Getter and Setter for amount
    public function getAmount(): float {
        return $this->amount;
    }

    public function setAmount(float $amount): void {
        $this->amount = $amount;
    }

    // Getter and Setter for transaction_type
    public function getTransactionType(): string {
        return $this->transaction_type;
    }

    public function setTransactionType(string $transaction_type): void {
        $this->transaction_type = $transaction_type;
    }

    // Getter and Setter for status
    public function getStatus(): string {
        return $this->status;
    }

    public function setStatus(string $status): void {
        $this->status = $status;
    }

    // Getter and Setter for date
    public function getDate(): string {
        return $this->date;
    }

    public function setDate(string $date): void {
        $this->date = $date;
    }
}


?>