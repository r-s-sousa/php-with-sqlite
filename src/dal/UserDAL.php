<?php

declare(strict_types=1);

namespace app\dal;

use PDO;
use app\model\User;

class UserDAL
{
    public function __construct(private PDO $connection)
    {
    }

    public function createTableIfNotExists(): void
    {
        $this->connection->exec('CREATE TABLE IF NOT EXISTS users (id INTEGER PRIMARY KEY AUTOINCREMENT, name TEXT, email TEXT)');
    }

    public function deleteUsers(): void
    {
        $this->connection->exec('DELETE FROM users');
    }

    public function insertData(string $name, string $email): void
    {
        $stmt = $this->connection->prepare('INSERT INTO users (name, email) VALUES (:name, :email)');
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
    }

    /** @return array<User>*/
    public function getUsers(): array
    {
        $stmt = $this->connection->query('SELECT * FROM users');
        if (!$stmt) {
            return [];
        }
        return $stmt->fetchAll(PDO::FETCH_CLASS, User::class);
    }
}
