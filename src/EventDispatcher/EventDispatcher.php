<?php

declare(strict_types=1);

namespace Core\EventDispatcher;

use Core\Interfaces\ListenerProvider;
use Psr\Container\ContainerInterface;
use Psr\EventDispatcher\StoppableEventInterface;
use Psr\EventDispatcher\EventDispatcherInterface;

class EventDispatcher implements EventDispatcherInterface
{

    /**
     * Container for create listeners with dependencies
     * @var ContainerInterface
     */
    protected ContainerInterface $container;

    /**
     * Some listener provider
     * @var ListenerProvider
     */
    protected ListenerProvider $provider;

    public function __construct(ListenerProvider $provider, ContainerInterface $container)
    {
        $this->provider = $provider;
        $this->container = $container;
    }

    /**
     * Provide all relevant listeners with an event to process.
     *
     * @param object $event
     *   The object to process.
     *
     * @return object
     *   The Event that was passed, now modified by listeners.
     */
    public function dispatch(object $event): object
    {

        $canStop = $event instanceof StoppableEventInterface;

        if ($canStop && $event->isPropagationStopped()) {
            return $event;
        }

        foreach ($this->provider->getListenersForEvent($event) as $listenerClass) {
            $listenerObject = $this->container->get($listenerClass);
            $listenerObject->setObject($event->getObject());
            $listenerObject->trigger();
            if ($canStop && $event->isPropagationStopped()) {
                break;
            }
        }

        return $event;
    }

}
