<?php

namespace App\Infrastructure;

use Common\Type\Id;
use App\Domain\Aggregate\Cart;
use Broadway\EventStore\EventStore;
use Broadway\EventHandling\EventBus;
use App\Domain\Repository\CartRepository;
use Broadway\EventSourcing\EventSourcingRepository;
use Broadway\EventSourcing\AggregateFactory\NamedConstructorAggregateFactory;

/**
 * CartBroadwayRepository is EventSourcingRepository for fetching and saving 
 * data in the event store
 */
final class CartBroadwayRepository implements CartRepository
{
    /** @var EventSourcingRepository */
    private $eventSourcingRepository;

    public function __construct(
        EventStore $eventStore,
        EventBus $eventBus,
        array $eventStreamDecorators = []
    ) {
        $this->eventSourcingRepository = new EventSourcingRepository(
            $eventStore,
            $eventBus,
            User::class,
            new NamedConstructorAggregateFactory(),
            $eventStreamDecorators
        );
    }

    public function get(Id $cartId): ?Cart
    {
        /** @var Cart $cart */
        $cart = $this->eventSourcingRepository->load($cartId->getValue());

        return $cart;
    }

    public function save(Cart $cart): void
    {
        $this->eventSourcingRepository->save($cart);
    }
}