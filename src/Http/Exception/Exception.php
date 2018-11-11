<?php
namespace Zit\Http\Exception;

use Zit\View\View;

class Exception
{
    /**
     * Exception handler.
     *
     * @param $exception
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public static function exceptionHandler($exception)
    {
        $code = $exception->getCode();

        if ($code != 404) {
            $code = 500;
        }

        http_response_code($code);

        if (config('app.debug')) {
            echo "<h1>Fatal error</h1>";
            echo "<p>Uncaught exception: '" . get_class($exception) . "'</p>";
            echo "<p>Message: '" . $exception->getMessage() . "'</p>";
            echo "<p>Stack trace:<pre>" . $exception->getTraceAsString() . "</pre></p>";
            echo "<p>Thrown in '" . $exception->getFile() . "' on line " . $exception->getLine() . "</p>";
        } else {
            $log = app()->storagePath() . '/logs/' . date('Y-m-d') . '.txt';

            ini_set('error_log', $log);

            $message = "Uncaught exception: '" . get_class($exception) . "'";
            $message .= " with message '" . $exception->getMessage() . "'";
            $message .= "\nStack trace: " . $exception->getTraceAsString();
            $message .= "\nThrown in '" . $exception->getFile() . "' on line " . $exception->getLine();

            error_log($message);

            View::renderErrorTemplate("$code.html");
        }
    }
}
