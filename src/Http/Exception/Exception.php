<?php
namespace Zit\Http\Exception;

class Exception
{
    /**
     * Exception handler
     *
     * @param Exception $exception
     */
    public static function exceptionHandler(Exception $exception)
    {
        $code = $exception->getCode();

        if ($code != 404) {
            $code = 500;
        }

        http_response_code($code);
    }
}
