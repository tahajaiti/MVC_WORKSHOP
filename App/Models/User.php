<?php

namespace App\Models;

use App\Core\Database;
use PDO;

class User
{

    private PDO $db;
    private int $id;
    private string $name;
    private string $email;
    private string $password;

    public function __construct(string $name = '', string $email = '', string $password = '', $id = 0){
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->db = Database::getConnection();
    }

    public function getId(): int {
        return $this->id;
    }

    public function setId(int $id): void {
        $this->id = $id;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = ucfirst($name);
    }

    public function verifyPassword(string $password): bool {
        return password_verify($password, $this->password);
    }

    public function save(): bool {
        $hashPass = password_hash($this->password, PASSWORD_BCRYPT);

        $sql = "INSERT INTO users (name, email, password) VALUES (:name, :email, :password)";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute([
            'name' => $this->name,
            'email' => $this->email,
            'password' => $hashPass
        ]);

        if ($result) {
            return true;
        }
        return false;
    }

    public function getByEmail(): ?User{
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['email' => $this->email]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result){
            $result = new User($result['name'], $result['email'], $result['password'], $result['id']);
        }

        return $result ?: null;
    }

}