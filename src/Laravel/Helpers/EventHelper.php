<?php

namespace Lyal\Checkr\Laravel\Helpers;

use Illuminate\Support\Str;
use Lyal\Checkr\Exceptions\UnhandledCheckrWebhook;

class EventHelper
{
    private $event;

    public function __construct($event)
    {
        $this->event = $event;
    }

    public function dispatch()
    {
        $className = '\\Lyal\\Checkr\\Laravel\\Events\\'.Str::studly(str_replace('.', '-', $this->event['type']));
        if (class_exists($className)) {
            event(new $className($this->event));
        } else {
            throw new UnhandledCheckrWebhook($this->event);
        }
    }

    public function getEventHandler()
    {
    }
}
