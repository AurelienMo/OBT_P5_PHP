<?php


namespace App\Controllers;


use App\Application\Database;
use App\Controllers\Traits\TwigTrait;
use Symfony\Component\HttpFoundation\Response;

abstract class AbstractController
{
use TwigTrait;

    /**
     * @var database|null
     */
    protected static $db;

    public static function getdb()
    {
        if (is_null(self::$db)){
            self::$db = self::configureDatabase();
        }
        return self::$db;
    }

        public function renderResponse(string $template,array $paramsTemplate=[])
    {
        return new Response($this->render($template,$paramsTemplate));
    }

    public function getGlobalPHP(string $globalTarget)
    {
        $global = null;
        switch ($globalTarget){
            case 'GET':
                $global = $_GET;
                break;
            case 'POST':
                $global = $_POST;
                break;
            case 'SERVER':
                $global = $_SERVER;
                break;
        }
        return $global;
    }

    private static function configureDatabase()
    {
        $cfgDatabase = require(__DIR__.'/../../config/app/database.php');
//        dump([$cfgDatabase]);
        $database = new Database(
            sprintf("%s;dbname=%s", $cfgDatabase['dsn'], $cfgDatabase['dbname']),
            $cfgDatabase['user'],
            $cfgDatabase['password']
        );
        return $database;
    }
}