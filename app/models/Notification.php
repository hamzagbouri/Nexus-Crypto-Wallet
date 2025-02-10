<?php
class Notification {
    private int $id;
    private User $user;
    private string $message;
    private bool $read;

    public function __construct(int $id, User $user, string $message, bool $read = false) {
        $this->id = $id;
        $this->user = $user;
        $this->message = $message;
        $this->read = $read;
    }

    // Getter and Setter for id
    public function getId(): int {
        return $this->id;
    }

    public function setId(int $id): void {
        $this->id = $id;
    }

    // Getter and Setter for user
    public function getUser(): User {
        return $this->user;
    }

    public function setUser(User $user): void {
        $this->user = $user;
    }

    // Getter and Setter for message
    public function getMessage(): string {
        return $this->message;
    }

    public function setMessage(string $message): void {
        $this->message = $message;
    }

    // Getter and Setter for read
    public function isRead(): bool {
        return $this->read;
    }

    public function setRead(bool $read): void {
        $this->read = $read;
    }

    // Mark notification as read
    public function markAsRead(): void {
        $this->read = true;
    }
}
?>
