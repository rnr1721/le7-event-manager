<?php

declare(strict_types=1);

namespace Core\EventDispatcher;

use Psr\EventDispatcher\StoppableEventInterface;

class EventGeneric implements StoppableEventInterface
{

    private bool $propagationStopped = false;

    /**
     * If propagation is stopped
     * @return bool
     */
    public function isPropagationStopped(): bool
    {
        return $this->propagationStopped;
    }

    /**
     * Stop propagation
     * @return void
     */
    public function stopPropagation(): void
    {
        $this->propagationStopped = true;
    }

}
