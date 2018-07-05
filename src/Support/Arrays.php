<?php

namespace Zit\Support;

class Arrays
{

    /**
     * Return the value of a given key
     *
     * @param array $array
     * @param int|string|null $key
     * @param mixed $default
     * @return mixed
     */
    public static function get($array, $key, $default = null)
    {
        if (static::exists($array, $key)) {
            return $array[$key];
        }

        if (strpos($key, '.') === false) {
            return $default;
        }

        $items = $array;

        foreach (explode('.', $key) as $segment) {
            if (!is_array($items) || !static::exists($items, $segment)) {
                return $default;
            }

            $items = &$items[$segment];
        }

        return $items;
    }

    /**
     * Set a given key / value pair or pairs
     *
     * @param $array
     * @param array|int|string $keys
     * @param mixed $value
     * @return array|bool
     */
    public static function set(&$array, $keys, $value = null)
    {
        if (is_null($keys)) {
            return $array = $value;
        }

        if (is_array($keys)) {
            foreach ($keys as $key => $value) {
                self::set($array, $key, $value);
            }
        }

        foreach (explode('.', $keys) as $key) {
            if (!isset($array[$key]) || !is_array($array[$key])) {
                $array[$key] = [];
            }

            $array = &$array[$key];
        }

        $array = $value;

        return true;
    }

    /**
     * Checks if the given key exists in the provided array.
     *
     * @param array $array Array to validate
     * @param int|string $key The key to look for
     * @return bool
     */
    public static function exists($array, $key)
    {
        return array_key_exists($key, $array);
    }

    /**
     * Check if a given key or keys exists
     *
     * @param array $array
     * @param array|int|string$keys
     * @return bool
     */
    public static function has($array, $keys)
    {
        $keys = (array) $keys;

        if (!$array || $keys === []) {
            return false;
        }

        foreach ($keys as $key) {
            $items = $array;

            if (static::exists($items, $key)) {
                continue;
            }

            foreach (explode('.', $key) as $segment) {
                if (!is_array($items) || !static::exists($items, $segment)) {
                    return false;
                }

                $items = $items[$segment];
            }
        }

        return true;
    }

    public static function isEmpty($array, $keys = null)
    {
        if (is_null($keys)) {
            return empty($array);
        }

        $keys = (array) $keys;

        foreach ($keys as $key) {
            if (!empty(static::get($array, $key))) {
                return false;
            }
        }

        return true;
    }
}
