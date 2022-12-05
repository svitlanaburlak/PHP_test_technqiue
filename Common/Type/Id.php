<?php

declare(strict_types=1);


namespace Common\Type;


abstract class Id extends ValueObject
{
    private int $value;

    public function __construct(int $value)
    {
        $this->value = $value;
    }

    public function getValue(): int
    {
        return $this->value;
    }

    /**
     * @param ValueObject|self $o
     *
     * @return bool
     */
    protected function equalTo(ValueObject $o): bool
    {
        return ($o->getValue() === $this->getValue());
    }
}