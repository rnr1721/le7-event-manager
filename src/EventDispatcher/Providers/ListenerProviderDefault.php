<?php

/* Source: https://github.com/phly/phly-event-dispatcher */

namespace Core\EventDispatcher\Providers;

use Core\Interfaces\ListenerProviderInterface;
use function array_keys;
use function in_array;
use function sprintf;
use function usort;

class ListenerProviderDefault implements ListenerProviderInterface
{

    private array $listeners = [];

    /**
     * Get listeners for some event
     * @param object $event
     * @return iterable
     */
    public function getListenersForEvent(object $event): iterable
    {
        $priorities = array_keys($this->listeners);
        usort($priorities, function ($a, $b) {
            return $b <=> $a;
        });

        foreach ($priorities as $priority) {
            foreach ($this->listeners[$priority] as $eventName => $listeners) {
                if ($event instanceof $eventName) {
                    foreach ($listeners as $listener) {
                        yield $listener;
                    }
                }
            }
        }
    }

    /**
     * Attach listener to event
     * @param string $eventType
     * @param string $listenerClass
     * @param int $priority
     * @return void
     */
    public function on(string $eventType, string $listenerClass, int $priority = 1): void
    {
        $pPriority = sprintf('%d.0', $priority);
        if (
                isset($this->listeners[$pPriority][$eventType]) && in_array($listenerClass, $this->listeners[$pPriority][$eventType], true)
        ) {
            // Duplicate detected
            return;
        }
        $this->listeners[$pPriority][$eventType][] = $listenerClass;
    }

}
