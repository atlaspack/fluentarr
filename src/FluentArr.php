<?php


namespace Atlas\FluentArr;


class FluentArr extends ArrayObject
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