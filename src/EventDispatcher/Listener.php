<?php

declare(strict_types=1);

namespace Core\EventDispatcher;

abstract class Listener
{

    protected mixed $event;

    public function setEvent(object $event): void
    {
        $this->event = $event;
    }

}
