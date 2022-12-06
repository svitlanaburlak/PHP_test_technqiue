<?php

namespace App\Application\Command;

use Common\Type\Id;
use Broadway\Serializer\Serializable;

/**
 * Event which informs that the cart was created. 
 */
final class CartWasCreatedEvent implements Serializable
{
    /** @var int */
    public Id $id;

    /** @var int */
    public $amount;

    public function __construct(
        string $id,
        string $amount
    ) {
        $this->id = $id;
        $this->amount = $amount;
    }

    // deserialize and serialize Broadway requirements
    public static function deserialize(array $data): self
    {
        return new self(
            $data['id'],
            $data['amount'],
        );
    }

    public function serialize(): array
    {
        return [
            'id' => $this->id,
            'amount' => $this->amount,
        ];
    }
}