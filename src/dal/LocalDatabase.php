<?php

declare(strict_types=1);

namespace app\dal;

use PDO;
use Exception;

class LocalDatabase
{
    private static PDO $db;

    public static function getConnection(): PDO
    {
        if (isset(self::$db)) {
            return self::$db;
        }

        if(!isset($_ENV['DATABASE_PATH'])) {
            throw new Exception('Environment variable DATABASE_PATH not set');
        }

        $databaseFilePath = dirname(__DIR__, 2).filter_var($_ENV['DATABASE_PATH'], FILTER_SANITIZE_SPECIAL_CHARS);

        self::$db = new PDO('sqlite:' . $databaseFilePath);
        self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return self::$db;
    }
}
