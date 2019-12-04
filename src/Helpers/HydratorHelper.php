<?php


namespace App\Helpers;

use App\Model\AbstractModel;
use Reflection;
use ReflectionClass;
class HydratorHelper
{
    public static function hydrate(array $datas, string $classModel, bool $singleResult = false)
    {
        $modelObject = self::getClass($classModel);
        $items = [];
        if ($singleResult) {
            $items[] = self::hydrateDatas($datas, $modelObject);
        } else {
            foreach ($datas as $line) {
                $items[] = self::hydrateDatas($line, $modelObject);
            }
        }
        var_dump($items);
        return $items;
    }
    private static function hydrateDatas(array $datasLine, AbstractModel $object)
    {
        foreach ($datasLine as $property => $value) {
            $method = 'set'.ucfirst($property);
            if (is_callable([$object, $method])) {
                $object->$method($value);
            }
        }
        return $object;
    }
}