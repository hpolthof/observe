<?php

class EchoEvent extends \Observe\Observable
{
    public static function getBindings() {
        return ['print'];
    }

    public function dispatch() {
        echo "Hello {$this->name}!";
    }
}