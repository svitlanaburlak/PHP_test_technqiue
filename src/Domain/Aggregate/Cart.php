<?php

namespace App\Domain\Aggregate;

use Common\Type\Id;
use App\Domain\VO\Coupon;
use App\Domain\CommonValidator;

class Cart {

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
}

