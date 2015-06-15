<?php namespace Observe;

interface CallableEvent
{
    public function __construct(array $parameters = []);

    public function dispatch();

    /**
     * This function should return an array of event names.
     * @return array
     */
    public static function getBindings();
}
