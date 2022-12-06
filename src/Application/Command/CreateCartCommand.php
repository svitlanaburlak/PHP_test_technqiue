<?php

namespace App\Application\Command;

use Common\Type\Id;

/**
 * Implementation of WriteModel in CQRS
 * Command contains fileds necessary to create a cart
 */
final class CreateCartCommand
{
    /** @var int */
    public Id $cartId;

    /** @var int */
    public $cartAmount;
}