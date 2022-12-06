<?php

namespace App\Domain\Repository;


use App\Domain\Aggregate\Cart;
use Common\Type\Id;

interface CartRepository
{
    public function save(Cart $cart): void;

    public function get(Id $cartId): ?Cart;
}