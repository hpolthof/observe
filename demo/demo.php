<?php

use Observe\Event;

// Register the EchoEvent as print.
Event::registerObservable('print', new EchoEvent);

// Fire the print Event and pass a name as a parameter.
Event::fire('print', ['name' => 'World']);
