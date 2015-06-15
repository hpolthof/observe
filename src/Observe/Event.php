<?php namespace Observe;

class Event
{
    protected static $observables = [];

    public static function registerObservables(array $observables) {
        foreach($observables as $observable) {
            self::registerObservable($observable);
        }
    }

    public static function registerObservable($observable) {
        $name = self::getClassName($observable);

        if(self::isCallableEvent($name)) {
            foreach(call_user_func([$name, 'getBindings']) as $binding) {
                self::$observables[$binding][] = $name;
            }
        } else {
            throw new ObserveException("{$name} is not an instance of CallableEvent.");
        }
    }

    public static function fire($event, array $parameters = []) {
        if(array_key_exists($event, self::$observables) === FALSE) {
            return;
        }

        foreach(self::$observables[$event] as $observable) {
            $object = new $observable($parameters);
            $object->dispatch();
            unset($object);
        }
    }

    /**
     * @param $name
     * @return bool
     */
    protected static function isCallableEvent($name)
    {
        $callable = array_search('Observe\CallableEvent', class_implements($name)) !== FALSE;
        return $callable;
    }

    /**
     * @param $observable
     * @return null|string
     */
    protected static function getClassName($observable)
    {
        $name = null;

        if (is_string($observable)) {
            $name = $observable;
        } elseif (is_object($observable)) {
            $name = get_class($observable);
        }
        return $name;
    }
}