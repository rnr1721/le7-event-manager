<?php

declare(strict_types=1);

namespace Core\Interfaces;

use Psr\EventDispatcher\ListenerProviderInterface as ListenerProvider;

interface ListenerProviderInterface extends ListenerProvider
{

    /**
     * Attach listener to event
     * @param string $eventType Event class
     * @param string $listenerClass Listener class
     * @param int $priority Priority
     * @return void
     */
    public function on(string $eventType, string $listenerClass, int $priority = 1): void;
}
