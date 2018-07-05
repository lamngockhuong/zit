<?php

class View
{
    /**
     * Render a view file
     *
     * @param string $view The view file
     * @param array $args Associative array of data to display in the view (optional)
     * @throws Exception
     */
    public static function render($view, array $args = [])
    {
        extract($args, EXTR_SKIP);

        $file = dirname(__DIR__) . "resources/views/$view";

        if (is_readable($file)) {
            require $file;
        } else {
            throw new Exception("$file not found");
        }
    }

    /**
     * Render a view template using Twig
     *
     * @param string $template The template file
     * @param array $args Associative array of data to display in the view (optional)
     * @throws Twig_Error_Loader
     * @throws Twig_Error_Runtime
     * @throws Twig_Error_Syntax
     */
    public static function renderTemplate($template, array $args = [])
    {
        static $twig = null;

        if ($twig === null) {
            $loader = new Twig_Loader_Filesystem(dirname(__DIR__) . '/resources/views');
            $twig = new Twig_Environment($loader);
        }

        echo $twig->render($template, $args);
    }
}
