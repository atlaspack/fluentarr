<?php


namespace Atlas\FluentArr;


use Iterator, ArrayAccess, Countable;


class FluentArr extends ArrayObject implements Iterator, ArrayAccess, Countable
{
    public function __construct(array $array = [])
    {
        parent::__construct($array);
    }

    public function &__get($offset)
    {
        return $this->get($offset);
    }

    public function __set($offset, $value)
    {
        $this->set($offset, $value);
    }
}