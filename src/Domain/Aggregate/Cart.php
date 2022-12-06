<?php

namespace App\Domain\Aggregate;

use Common\Type\Id;
use App\Domain\VO\Coupon;
use App\Domain\CommonValidator;
use App\Application\Command\CartWasCreatedEvent;
use Broadway\EventSourcing\EventSourcedAggregateRoot;

/**
 * Cart has to extends EventSourcedAggregateRoot of Broadway 
 * to be able to apply events and get the data from the database
 */
class Cart extends EventSourcedAggregateRoot
{
    //====================
    // Properties
    //====================

    /** @var int */
    private Id $id;

    /** @var int */
    private $amount;

    //====================
    // Getters & Setters
    //====================

    public function getId(): int
    {
        return $this->id;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }
 
    public function setAmount($amount) : self
    {
        $this->amount = $amount;

        return $this;
    }

    //====================
    // Methods
    //====================

    public function calculateCost(Coupon $coupon): int
    {
        CommonValidator::validateAmount($this->amount);

        $finalCost = $this->amount - ($coupon->applyToCart())->getDiscount();
        
        return $finalCost;
    }

    // Broadway requirements
    public static function create(
        int $cartId,
        int $cartAmount

    ): self {
        $cart = new static();
        $cart->apply(
            new CartWasCreatedEvent($cartId, $cartAmount)
        );
 
        return $cart;
    }

    protected function applyCartWasCreatedEvent(CartWasCreatedEvent $event): void
    {
        $this->id = $event->id;
        $this->amount = $event->amount;
    }

    public static function instantiateForReconstitution(): self
    {
        return new static();
    }

    public function getAggregateRootId(): string
    {
        return $this->getId();
    }
}

