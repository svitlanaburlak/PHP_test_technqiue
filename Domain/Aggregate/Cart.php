<?php

namespace Domain\Aggregate;

use Domain\VO\Coupon;

class Cart {

    //====================
    // Properties
    //====================

    /** @var int */
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
    // Setters - may not be necessary for VO
    //====================

    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }


    public function setAmount(int $amount): self
    {
        $this->amount = $amount;
        return $this;
    }

    //====================
    // Methods
    //====================

    public function __construct()
    {
        return;
    }

}