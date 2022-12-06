<?php

namespace App\Application\Command;

use App\Domain\Aggregate\Cart;
use App\Domain\Repository\CartRepository;
use Broadway\CommandHandling\SimpleCommandHandler;

/**
 * This handler is responsible for processing 
 * a creation of a car (CreateCartCommand)
 */
final class CreateCartHandler extends SimpleCommandHandler
{
    /** @var CartRepository */
    private $cartRepository;

    public function __construct(CartRepository $cartRepository)
    {
        $this->cartRepository = $cartRepository;
    }

    public function handleCreateCartCommand(CreateCartCommand $createCartCommand): void
    {
        $cart= Cart::create(
            $createCartCommand->cartId,
            $createCartCommand->cartAmount,
        );

        $this->cartRepository->save($cart);
    }
}