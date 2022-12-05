<?php

namespace App\Domain\VO;

use DateTime;
use Common\Type\Id;
use Common\Type\ValueObject;
use App\Domain\CommonValidator;

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

        CommonValidator::validateDiscount($discount);

        CommonValidator::validateTimes($timesUsed);

        $this->code = 'MERRYXMAS';
        $this->discount = $discount;
        $this->status = $status;
        $this->timesUsed = $timesUsed;
        $this->createdAt = new DateTime();
        // to test coupon older than 2 months
        // $this->createdAt = new DateTime('2022-10-04 14:52:48');
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

    public function applyToCart() {

        CommonValidator::validateTimesUsed($this->timesUsed);

        CommonValidator::validateStatus($this->status);

        CommonValidator::validateDate($this->createdAt);

        return new self($this->discount, $this->status, $this->timesUsed++ );
        
    }

    /**
     * @param ValueObject|self $o
     *
     * @return bool
     */
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