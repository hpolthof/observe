<?php
/**
 * Created by PhpStorm.
 * User: paul
 * Date: 15-6-15
 * Time: 8:19
 */

namespace Observe;


abstract class Observable implements CallableEvent
{
    private $__parameters = [];

    public function __construct(array $parameters = []) {
        $this->__parameters = $parameters;
    }

    public function __get($name) {
        if(array_key_exists($name, $this->__parameters)) {
            return $this->__parameters[$name];
        } else {
            throw new ObserveException("Variable [{$name}] was not found.");
        }
    }
}