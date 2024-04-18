<?php

declare (strict_types=1);

use Rafael\PhpWithSqlite\Models\User;

require __DIR__ . '/vendor/autoload.php';

function connectToDatabase(): PDO
{
    $db = new PDO('sqlite:database.db');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $db;
}

function createTable(PDO $db): void
{
    $db->exec('CREATE TABLE IF NOT EXISTS users (id INTEGER PRIMARY KEY AUTOINCREMENT, name TEXT, email TEXT)');
}

function insertData(PDO $db, string $name, string $email): void
{
    $stmt = $db->prepare('INSERT INTO users (name, email) VALUES (:name, :email)');
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
}

function getUsers(PDO $db): array
{
    $stmt = $db->query('SELECT * FROM users');
    return $stmt->fetchAll(PDO::FETCH_CLASS, User::class);
}

function showUsers(array $users): void
{
    /** @var User $user */
    foreach ($users as $user) {
        echo "Id: {$user->id} | Name: {$user->name} | Email: {$user->email} <br>";
    }
}

function deleteUsers(PDO $db): void
{
    $db->exec('DELETE FROM users');
}

$db = connectToDatabase();
//deleteUsers($db);
createTable($db);
insertData($db, 'Rafael', 'rafael@outlook.com');
$users = getUsers($db);
showUsers($users);
