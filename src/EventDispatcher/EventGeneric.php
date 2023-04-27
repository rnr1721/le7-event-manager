<?php

declare(strict_types=1);

namespace Core\EventDispatcher;

use Psr\EventDispatcher\StoppableEventInterface;

class EventGeneric implements StoppableEventInterface
{

    private mixed $object;
    private bool $propagationStopped = false;

    public function __construct(mixed $object)
    {
        $this->object = $object;
    }

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

    /**
     * Get current element
     * @return mixed
     */
    public function getObject(): mixed
    {
        return $this->object;
    }

}
