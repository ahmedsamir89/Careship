<?php

namespace App\Helper;


class Helper
{
    /**
     * @param $object
     *
     * @return string
     * @throws \Exception
     */
    public static function getShortClassName($object): string
    {
        if(!is_object($object)) {
            throw new \Exception('This var is not an object');
        }
        $class = get_class($object);
        $array = explode('\\', $class);
        return array_pop($array);
    }
}