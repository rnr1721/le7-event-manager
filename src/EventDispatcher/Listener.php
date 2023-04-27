<?php

declare(strict_types=1);

namespace Core\EventDispatcher;

abstract class Listener
{

    protected mixed $object;

    public function setObject(mixed $object): void
    {
        $this->object = $object;
    }

}
