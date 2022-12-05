<?php

namespace Common\Type;


abstract class ValueObject
{
    abstract protected function equalTo(ValueObject $o): bool;
}