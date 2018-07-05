<?php

namespace Zit\Routing;

use BadMethodCallException;

abstract class Controller
{
    /**
     * Parameters from matched route
     *
     * @var array
     */
    protected $params = [];

    /**
     * Controller constructor.
     * @param array $params Parameters from the route
     */
    public function __construct($params)
    {
        $this->params = $params;
    }

    /**
     * Handle calls to missing methods on the controller.
     *
     * @param string $name Method name
     * @param array $arguments Arguments passed to the method
     * @throws BadMethodCallException
     */
    public function __call($name, $arguments)
    {
        throw new BadMethodCallException("Method $name not found in controller " . get_class($this));
    }

    /**
     * Before filter - called before an action method.
     *
     * @return void
     */
    protected function before()
    {
    }

    /**
     * After filter - called after an action method.
     *
     * @return void
     */
    protected function after()
    {
    }
}
