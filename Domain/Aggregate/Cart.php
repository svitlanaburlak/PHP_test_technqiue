<?php

namespace Domain\Aggregate;

use Domain\VO\Coupon;

class Cart {

    //====================
    // Properties
    //====================

    /** @var int */
    // can be transformed into VO
    private $id;

    /** @var int */
    private $amount;

    //====================
    // Getters
    //====================

    public function getId(): int
    {
        return $this->id;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    //====================
    // Methods
    //====================

    public function calculateCost(int $amount, Coupon $coupon): int
    {
        if ($amount <= 50) {
            throw new \InvalidArgumentException('You can not use coupon for the cart of less than 50€ ');
        }

        $finalCost = $amount - ($coupon->applyToCart())->discount;
        
        return $finalCost;
    }

}

