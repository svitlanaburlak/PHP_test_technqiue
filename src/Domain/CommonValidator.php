<?php

declare(strict_types=1);


namespace App\Domain;

use DateTimeImmutable;

class CommonValidator
{
    public static function validateDiscount(int $discount) {
        if ($discount < 0 || empty($discount)) {
            throw new \InvalidArgumentException("Discount should be a positive value: {$discount}.");
        }
    }
    
    public static function validateTimes(int $timesUsed) {
        if ($timesUsed < 0) {
            throw new \InvalidArgumentException("Number of times used should be a positive value: {$timesUsed}.");
        }
    }

    public static function validateTimesUsed(int $timesUsed) {
        if ($timesUsed >= 10) {
            throw new \DomainException("You can not use one coupon more than 10 times");
        }
    }

    public static function validateStatus(bool $status) {
        if (!$status) {
            throw new \DomainException("This coupon is not valid anymore");
        }
    }

    public static function validateDate(DateTimeImmutable $createdAt) {
        $difference = $createdAt->diff(new DateTimeImmutable());

        if( intval($difference->format('%a')) > 60) {
            throw new \DomainException("You can not use coupon older than 2 months");
        }

    }

    public static function validateAmount(int $amount) {
        if ($amount <= 50) {
            throw new \InvalidArgumentException('You can not use coupon for the cart of less than 50€ ');
        }
    }


}
