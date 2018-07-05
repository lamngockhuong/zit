<?php
namespace Zit\Http\Exception;

class Error
{
    /**
     * Error handler. Convert all errors to Exception by throwing an ErrorException
     *
     * @param int $level Error level
     * @param string $message Error message
     * @param string $file Filename the error was raised in
     * @param int $line Line number in the file
     * @throws ErrorException
     */
    public static function errorHandler($level, $message, $file, $line)
    {
        if (error_reporting() != 0) {
            throw new ErrorException($message, 0, $level, $file, $line);
        }
    }
}
