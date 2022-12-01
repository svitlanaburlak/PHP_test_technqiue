<?php

namespace Domain\VO;

use DateTime;

class Coupon {
    
    //====================
    // Properties
    //====================

    /** @var int */
    private $id;

    /** @var string */
    private $code;

    /** @var int */
    private $discount;

    /** @var DateTime */
    private $createdAt;

    /** @var bool */
    private $status;

    //====================
    // Getters
    //====================

    public function getId(): int
    {
        return $this->id;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function getDiscount(): int
    {
        return $this->discount;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    public function getStatus(): bool
    {
        return $this->status;
    }

    //====================
    // Methods
    //====================

    public function __construct(string $code, int $discount, bool $status)
    {
        if ($discount < 0) {
            throw new \InvalidArgumentException("Discount should be a positive value: {$discount}.");
        }

        $this->code = $code;
        $this->discount = $discount;
        $this->status = $status;

        $this->ctreatedAt = new DateTime();
    }
}