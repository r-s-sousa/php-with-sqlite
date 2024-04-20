<?php

declare (strict_types = 1);

require __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;
use app\dal\UserDAL;
use app\view\UserView;
use app\dal\LocalDatabase;

$dotenv = Dotenv::createImmutable(__DIR__ . '/../config/');
$dotenv->load();

$dbConnection = LocalDatabase::getConnection();

$userDAL = new UserDAL($dbConnection);
$userDAL->createTableIfNotExists();
$userDAL->deleteUsers();
$userDAL->insertData('Rafael', 'rafael@outlook.com');
$users = $userDAL->getUsers();
UserView::showUsers($users);
