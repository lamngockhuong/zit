<?php

namespace Zit\Container;

class Container
{
    /**
     * The current globally available container (if any).
     *
     * @var static
     */
    protected static $instance;

    public static function getInstance()
    {
        if (is_null(static::$instance)) {
            static::$instance = new static;
        }

        return static::$instance;
    }

    /**
     * Set the shared instance of the container.
     *
     * @param Container|null $container
     * @return Container|static
     */
    public static function setInstance(Container $container = null)
    {
        return static::$instance = $container;
    }
}
