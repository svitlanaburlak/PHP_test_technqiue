<?php

namespace Common\Type;


abstract class ValueObject
{
    public function equals(?ValueObject $o): bool
    {
        if ($o === null) {
            return $this === null;
        }
        return get_class($this) === get_class($o) && $this->equalTo($o);
    }

    abstract protected function equalTo(ValueObject $o): bool;
}