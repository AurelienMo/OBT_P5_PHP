<?php
namespace App\Repository;

use App\Application\Database;
use ReflectionClass;

abstract class AbstractRepository
{
    /** @var Database|null */
    protected static $db;
    public static function getDb()
    {
        if (is_null(self::$db)) {
            self::$db = self::configureDatabase();
        }
        return self::$db;
    }
    private static function configureDatabase()
    {
        $cfgDatabase = require(__DIR__.'/../../config/app/database.php');
        $database = new Database(
            sprintf('%s;dbname=%s', $cfgDatabase['dsn'], $cfgDatabase['dbname']),
            $cfgDatabase['user'],
            $cfgDatabase['password']
        );
        return $database;
    }
    protected static function getClass(string $classModel)
    {
        $reflectClass = new ReflectionClass($classModel);
        $name = $reflectClass->getName();
        return new $name();
    }
}