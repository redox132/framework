<?php

namespace RidiumFramework\Support\Arr;

class Arr
{

    // 
    public static function find(array $array, callable $callback, $default = null)
    {
        foreach ($array as $key) {
            if ($callback($key)) {
                return $key;
            }
        }
        return $default;
    }

    public static function hasKey(array $array, callable $callback, $default = false)
    {
        foreach ($array as $key => $value) {
            if ($callback($key, $value)) {
                return true;
            }
        }
        return $default;
    }

    public static function pluck(array $array, string $key)
    {
        $values = [];

        foreach ($array as $item) {
            if (is_array($item) && isset($item[$key])) {
                $values[] = $item[$key];
            } elseif (is_object($item) && isset($item[$key])) {
                $values[] = $item->key;
            }
        }
        return $values;
    }

    static public function where(array $array, callable $callback, $default = null): array
    {
        $results = [];

        foreach ($array as $key => $value) {
            if ($callback($value, $key)) {
                $results[$key] = $value;
            }
        }

        return $results;
    }

    static public function some(array $array, callable $callback)
    {
        foreach ($array as $key => $value) {
            if ($callback($value, $key))
            {
                return true;
            }
        }

        return false;
    }
    
}
