<?php

namespace Domain\VO;

use DateTime;

class Coupon {
    
    //====================
    // Properties
    //====================

    /** @var int */
    // can be transformed into VO 
    private $id;

    /** @var string */
    private $code;

    /** @var int */
    private $discount;

    /** @var DateTime */
    private $createdAt;

    /** @var bool */
    private $status;

    /** @var int */
    private $timesUsed;

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

    public function __construct(string $code, int $discount, bool $status, int $timesUsed)
    {
        if ($discount < 0) {
            throw new \InvalidArgumentException("Discount should be a positive value: {$discount}.");
        }

        if ($timesUsed < 0) {
            throw new \InvalidArgumentException("Number of times used should be a positive value: {$timesUsed}.");
        }

        $this->code = $code;
        $this->discount = $discount;
        $this->status = $status;
        $this->timesUsed = $timesUsed;
        $this->createdAt = new DateTime();
    }

    public function checkDate() {

        // check how old is coupon
        $difference = $this->createdAt->diff(new DateTime());

        if( intval($difference->format('%a')) > 60) {
            return false;
        }

        return true;
        
    }

    public function deactivate() {

        return new self($this->code, $this->discount, $this->status = false, $this->timesUsed);
    }

    public function checkStatus() {

        if( $this->status == false) {
            return false;
        }

        return true;
        
    }

    public function applyToCart() {

        if ($this->timesUsed > 10) {
            $this->deactivate();
            throw new \DomainException("You can not use one coupon more than 10 times");
        }

        if (!$this->checkStatus()) {
            throw new \DomainException("This coupon is not valid anymore");
        }

        if (!$this->checkDate()) {
            $this->deactivate();
            throw new \DomainException("You can not use coupon older than 2 months");
        }

        return new self($this->code, $this->discount, $this->status, $this->timesUsed++ );
        
    }

    public function equalTo(Coupon $other) {
        return $this->code === $other->code && 
        $this->discount === $other->discount &&
        $this->status === $other->status &&
        $this->timesUsed = $other->timesUsed &&
        $this->createdAt = $other->createdAt;
    }

}