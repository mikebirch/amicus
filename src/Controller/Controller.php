<?php

namespace Showus\Controller;

/**
 * Base controller
 */
abstract class Controller
{

    /**
     * Parameters from the matched route
     * @var array<string,string>
     */
    protected $route_params = [];

    /**
     * Class constructor
     *
     * @param array<string,string> $route_params  Parameters from the route
     *
     * @return void
     */
    public function __construct($route_params)
    {
        $this->route_params = $route_params;
    }

    /**
     * Magic method called when a non-existent or inaccessible method is
     * called on an object of this class. Used to execute before and after
     * filter methods on action methods. Action methods need to be named
     * with an "Action" suffix, e.g. indexAction, showAction etc.
     *
     * @param string $name  Method name
     * @param array<mixed> $args Arguments passed to the method
     *
     * @return void
     */
    public function __call(string $name, array $args)
    {
        $method = $name . 'Action';

        if (method_exists($this, $method)) {
            if ($this->before() !== false) {
                $callback = [$this, $method];
                if (is_callable($callback)) {
                    call_user_func_array($callback, $args);
                }
                $this->after();
            }
        } else {
            throw new \Exception("Method $method not found in controller " . get_class($this));
        }
    }

    /**
     * Before filter - called before an action method.
     *
     * @return mixed
     */
    protected function before()
    {
    }

    /**
     * After filter - called after an action method.
     *
     * @return mixed
     */
    protected function after()
    {
    }
}
