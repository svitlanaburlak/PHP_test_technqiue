<?php

namespace App\Domain\VO;

use DateTime;
use Common\Type\Id;
use Common\Type\ValueObject;

class Coupon extends ValueObject
{
    //====================
    // Properties
    //====================

    /** @var int */
    private Id $id;

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

    public function getTimesUsed()
    {
        return $this->timesUsed;
    }

    //====================
    // Methods
    //====================

    public function __construct(int $discount, bool $status, int $timesUsed)
    {
        if ($discount < 0) {
            throw new \InvalidArgumentException("Discount should be a positive value: {$discount}.");
        }

        if ($timesUsed < 0) {
            throw new \InvalidArgumentException("Number of times used should be a positive value: {$timesUsed}.");
        }

        $this->code = 'MERRYXMAS';
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

        return new self($this->discount, $this->status = false, $this->timesUsed);
    }

    public function checkStatus() {

        if( $this->status == false) {
            return false;
        }

        return true;
        
    }

    public function applyToCart() {

        // this validations can be separated into separate validator class.
        if ($this->timesUsed >= 10) {
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

        return new self($this->discount, $this->status, $this->timesUsed++ );
        
    }

    protected function equalTo(ValueObject $other) : bool
    {
        return 
        ($other->getCode() === $this->getCode() && 
        $other->getDiscount() === $this->getDiscount() &&
        $other->getStatus() === $this->getStatus() &&
        $other->getTimesUsed() === $this->getTimesUsed() &&
        $other->getCreatedAt() === $this->getCreatedAt());
        ;
    }

}