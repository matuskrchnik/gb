<?php

namespace Controller\Utils;

class Utils
{
    public static function sortBy($sortKey, array $data): array
    {
        $_data = array();
        foreach ($data as $key => $val)
        {
            $_data[$key] = $val[$sortKey];
        }

        return $_data;
    }
}
