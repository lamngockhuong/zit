<?php

use Zit\Container\Container;
use Zit\Support\Arrays;

if (!function_exists('d')) {
    /**
     * Dump.
     *
     * @param mixed ...$args
     */
    function d(...$args) {
        echo '<pre>';
        foreach ($args as $arg) {
            var_dump($arg);
        }
        echo '</pre>';
    }
}

if (!function_exists('dd')) {
    /**
     * Dump and die.
     *
     * @param mixed ...$args
     */
    function dd(...$args) {
        d(...$args);
        die(1);
    }
}

if (!function_exists('app')) {
    /**
     * Get the application from Zit container
     *
     * @return Zit\Foundation\Application|Container
     */
    function app() {
        return Container::getInstance();
    }
}

if (!function_exists('config')) {
    /**
     * @param int|string|array|null $key
     * @param mixed $default
     * @return Zit\Foundation\Application|Container
     */
    function config($key = null, $default = null) {
        $config = app()->getConfig();

        if (is_null($key)) {
            return $config;
        }

        if (is_array($key)) {
            foreach ($key as $k => $value) {
                Arrays::set($config, $k, $value);
            }

            app()->setConfig($config);

            return true;
        }

        return Arrays::get($config, $key, $default);
    }
}

if (!function_exists('request')) {
    /**
     * Get the content from the link.
     *
     * @param $link
     * @return mixed
     */
    function request($link) {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $link,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false
        ));
        $response = curl_exec($curl);
        curl_close($curl);

        return $response;
    }
}

